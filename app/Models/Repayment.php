<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Repayment extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $year = Carbon::now()->year;
            $latest = DB::table('repayments')
                ->whereYear('created_at', $year)
                ->orderBy('id', 'desc')
                ->first();

            $nextNumber = 1;

            if ($latest && preg_match('/REP-' . $year . '-(\d+)/', $latest->repayment_id, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            }

            $model->repayment_id = 'REP-' . $year . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        });
    }

    public function disbursement()
    {
        return $this->belongsTo(Disbursement::class, 'disbursement_id', 'id');
    }

    public function getMemberNameAttribute() {
        return $this->disbursement->loan_application->member->name ?? "";
    }

    public function getLoanTypeAttribute() {
        return $this->disbursement->loan_application->loan_type->name ?? "";
    }

    public function getStatusAttribute($value)
    {
        return $value == 'pending' && date('Y-m-d', strtotime($this->repayment_date)) < date('Y-m-d') ? 'overdue' : $value;
    }

    public function getAmountAttribute($value)
    {
        return fmod($value, 1) == 0 ? number_format($value, 0) : rtrim(rtrim(number_format($value, 2, '.', ''), '0'), '.');
    }
}
