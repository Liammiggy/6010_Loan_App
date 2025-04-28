<?php

namespace App\Services;

use App\Models\{LoanApplication, Repayment, LoanType};
use Carbon\Carbon;

class DashboardService extends AbstractService
{
    
    protected string $model;
    protected bool $showWithRelations = true;
    protected array $customFilters = [];

    public function countPendingApplications() {
        $query = LoanApplication::where('status', 'pending');

        return [
            'count' => $query->count(),
            'today' => $query->whereDate('created_at', now())->count(),
        ];
    }

    public function overDuePayments() {
        $query = Repayment::where('status', 'pending')
                      ->where('repayment_date', '<', now());

        return [
            'count' => $query->count(),
            'sum' => $query->sum('amount'),
        ];
    }


    public function activeLoans()
    {
        $activeLoans = LoanApplication::where('status', 'approved')
            ->whereHas('disbursement', function ($query) {
                $query->whereNotNull('id'); // Ensure it has a disbursement
            })
            ->whereHas('disbursement.repayments', function ($query) {
                $query->whereIn('status', ['paid', 'waived']);
            })
            ->get()
            ->filter(function ($loan) {
                $paidRepaymentsCount = $loan->disbursement->repayments()
                    ->whereIn('status', ['paid', 'waived'])
                    ->count();

                return $paidRepaymentsCount < $loan->term;
            });

        $now = Carbon::now();
        $startOfThisWeek = $now->copy()->startOfWeek();
        $startOfLastWeek = $startOfThisWeek->copy()->subWeek();
        $endOfLastWeek = $startOfThisWeek->copy()->subSecond();
        
        $thisWeekLoans = $activeLoans->filter(function ($loan) use ($startOfThisWeek, $now) {
            $createdAt = Carbon::parse($loan->created_at);
            return $createdAt->between($startOfThisWeek, $now);
        });
        
        if ($thisWeekLoans->count() > 0) {
            $newLoansCount = $thisWeekLoans->count();
            $particulars = 'This Week';
        } else {
            $lastWeekLoans = $activeLoans->filter(function ($loan) use ($startOfLastWeek, $endOfLastWeek) {
                $createdAt = Carbon::parse($loan->created_at);
                return $createdAt->between($startOfLastWeek, $endOfLastWeek);
            });
        
            if ($lastWeekLoans->count() > 0) {
                $newLoansCount = $lastWeekLoans->count();
                $particulars = 'Last Week';
            } else {
                $newLoansCount = 0;
                $particulars = '';
            }
        }
        
        return [
            'count' => $activeLoans->count(),
            'new_loans' => $newLoansCount,
            'particulars' => $particulars, 
        ];
    }

    public function upcomingPayments() {
        return Repayment::where('status', 'pending')
            ->where('repayment_date', '>', now())
            ->orderBy('repayment_date', 'asc') 
        ->take(3)
        ->get();
    }

    public function recentLoanApplications() {
        return LoanApplication::orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

    public function loanDistributionByType() {
        return LoanApplication::selectRaw('loan_type_id, COUNT(*) as count')
        ->where('status', 'approved')
        ->whereHas('disbursement')
        ->groupBy('loan_type_id')
        ->with('loan_type') 
        ->get()
        ->map(function ($item) {
            return [
                'type' => $item->loan_type?->name ?? 'Unknown', 
                'count' => $item->count,
            ];
        });
    }

    public function getLoanTypes() {
        return LoanType::where('is_active', 1)->pluck('name');
    }

    public function totalLoans() {
        $now = Carbon::now();
        $startOfThisMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        $loanApplications = LoanApplication::where('status', 'approved')
            ->whereHas('disbursement', function ($query) {
                $query->where('status', 'approved');
            })
            ->get();

        $disbursementIds = $loanApplications->pluck('disbursement.id')->filter();

        $totalAmount = Repayment::whereIn('disbursement_id', $disbursementIds)
                    ->where('status', 'paid')
                    ->sum('amount');

        $thisMonthAmount = Repayment::whereIn('disbursement_id', $disbursementIds)
                    ->where('status', 'paid')
                    ->whereBetween('repayment_date', [$startOfThisMonth, $now])
                    ->sum('amount');

        $lastMonthAmount = Repayment::whereIn('disbursement_id', $disbursementIds)
                    ->where('status', 'paid')
                    ->whereBetween('repayment_date', [$startOfLastMonth, $endOfLastMonth])
                    ->sum('amount');

        $percentageChange = 0;
        if ($lastMonthAmount > 0) {
            $percentageChange = (($thisMonthAmount - $lastMonthAmount) / $lastMonthAmount) * 100;
        }

        return [
            'total_amount' => $totalAmount, #this should be the total amount of all loan applications + disbursements only the interest
            'percentage_change' => round($percentageChange, 2),  
        ];
    }
}
