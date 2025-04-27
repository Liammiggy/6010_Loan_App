<?php

namespace App\Services;

use App\Models\{Disbursement, LoanApplication, Repayment};

class DisbursementService extends AbstractService
{
    protected string $model = Disbursement::class;
    protected bool $showWithRelations = true;
    protected array $customFilters = [];

    public function getDisbursements(array $filters = []){
        $this->model = Disbursement::class;
        return $this->all($filters)->paginate(10);
    }

    public function getRepayments(array $filters = []){
        $this->model = Repayment::class;
        $this->relations(['disbursement']);
        return $this->all($filters)->paginate(10);
    }

    public function getApprovedLoans() {
        $this->model = LoanApplication::class;
        return $this->model::where('status', 'approved')->doesntHave('disbursement')->get();
    }

    public function getLoans($id) {
        $this->model = LoanApplication::class;
        return $this->model::where('id', $id)->get();
    }

    public function getDisbursement($id) {
        $this->model = Disbursement::class;
        return $this->model::where('loan_application_id', $id)->first();
    }

    public function store(array $data) {
        \DB::beginTransaction();
        $data['disbursement_date'] = now();

        $this->model = Disbursement::class;
        $disbursement = $this->model::find($this->model::create($data)->id);
        if(isset($data['status']) && $data['status'] == 'approved') {
            $interest = $disbursement->amount * ($disbursement->interest_rate / 100);
            $totalDue = $disbursement->amount + $interest;
            $amortization = $totalDue / $disbursement->term;
            $schedules = $disbursement->generateSchedule();

            foreach($schedules as $schedule) {
                Repayment::create([
                    'disbursement_id' => $disbursement->id,
                    'amount' => $amortization,
                    'repayment_date' => $schedule->format('Y-m-d h:i:s'),
                ]);
            }
        }
        \DB::commit();
        return ;

    }

    public function update(array $data, $id) {
        $this->model = Disbursement::class;
        $disbursement = $this->model::find($id);
        return $disbursement->update($data);
    }

}
