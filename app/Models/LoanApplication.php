<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LoanApplication extends Model
{
    public $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $year = Carbon::now()->year;
            $latest = DB::table('loan_applications')
                ->whereYear('created_at', $year)
                ->orderBy('id', 'desc')
                ->first();

            $nextNumber = 1;

            if ($latest && preg_match('/APP-' . $year . '-(\d+)/', $latest->application_id, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            }

            $model->application_id = 'APP-' . $year . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        });

        static::updating(function ($model) {
            if($model->status == 'approved') {
                $folderPath = $model->member->member_id . '/' .  $model->application_id;
                Storage::makeDirectory($folderPath);
            }
        });
    }

    public function member() {
        return $this->belongsTo(Member::class,'member_id','id');
    }

    public function loan_type() {
        return $this->belongsTo(LoanType::class,'loan_type_id', 'id');
    }

    public function disbursement() {
        return $this->HasOne(Disbursement::class, 'loan_application_id', 'id');
    }

    public function getMemberNameAttribute() {
        return $this->member?->name ?? 'Unknown';
    }

    public function getTermFrequencyAttribute() {
        return $this->term . " (". $this->frequency . ")";
    }

    public function getLoanTypeDetailAttribute() {
        $percent = fmod($this->interest_rate, 1) == 0
                                        ? number_format($this->interest_rate, 0)
                                        : rtrim(rtrim(number_format($this->interest_rate, 2, '.', ''), '0'), '.');

        return $this->loan_type?->name ?? 'Unknown' . ' ' . $percent . '%';
        
    }

}
