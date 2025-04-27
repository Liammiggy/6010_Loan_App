<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Disbursement extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $year = Carbon::now()->year;
            $latest = DB::table('disbursements')
                ->whereYear('created_at', $year)
                ->orderBy('id', 'desc')
                ->first();

            $nextNumber = 1;

            if ($latest && preg_match('/DIS-' . $year . '-(\d+)/', $latest->disbursement_id, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            }

            $model->disbursement_id = 'DIS-' . $year . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        });
    }

    public function loan_application() {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id', 'id');
    }

    public function getMemberNameAttribute() {
        return $this->loan_application?->member?->name ?? 'Unknown';
    }

    public function getLoanTypeNameAttribute() {
        return $this->loan_application?->loan_type?->name ?? 'Unknown';
    }

    public function getAmountAttribute() {
        return $this->loan_application?->amount ?? 0;
    }  
    
    public function getInterestRateAttribute() {
        return $this->loan_application?->interest_rate ?? 0;
    } 
    public function getTermAttribute() {
        return $this->loan_application->term;
    }

    private function addDays($date, $days) {
        $result = clone $date;
        $result->modify("+$days days");
        return $result;
    }

    private function addWeeks($date, $weeks) {
        return $this->addDays($date, $weeks * 7);
    }

    private function addMonths($date, $months) {
        $result = clone $date;
        $result->modify("+$months months");
        return $result;
    }

    public function generateSchedule() {
        $dates = [];
        $current = $this->disburstment_date instanceof \DateTime
        ? $this->disburstment_date
        : new \DateTime($this->disburstment_date);

        for ($i = 0; $i < $this->loan_application->term; $i++) {
            $dates[] = clone $current;

            $current = match ($this->loan_application->frequency) {
                'daily' => $this->addDays($current, 1),
                'weekly' => $this->addWeeks($current, 1),
                'semi-monthly' => $this->addDays($current, 15),
                'monthly' => $this->addMonths($current, 1),
                default => throw new \Exception("Invalid frequency: $this->loan_applicatiuon->frequency"),
            };
        }
        return $dates;
    }

}
