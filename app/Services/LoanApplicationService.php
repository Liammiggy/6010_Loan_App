<?php

namespace App\Services;

use App\Models\{LoanApplication, Member, LoanType, Disbursement};

class LoanApplicationService extends AbstractService
{
    protected string $model = LoanApplication::class;
    protected bool $showWithRelations = true;
    protected array $customFilters = [];

    public function getLoanApplications(array $filters = []) 
    {
        return $this->all($filters)->paginate(10);
    }

    public function getLoanApplication(array $filters=[]) 
    {
        $this->model = LoanApplication::class;
        return $this->model::where('application_id', $filters['id'])->first();
    }

    public function getMembers() {
        $this->model = Member::class;
        return $this->all([])->get();
    }

    public function getLoanTypes() {
        $this->model = LoanType::class;
        return $this->all([])->get();
    }

    public function newMember(array $data) {
        $allowed = ['name', 'email', 'phone', 'address'];
        $data = array_intersect_key($data, array_flip($allowed));
        $data['is_active'] = true;
        return Member::create($data);
    }

    public function create(array $data, $id)
    {
        $allowed = ['loan_type_id', 'interest_rate', 'amount', 'term', 'frequency','transaction_fee'];
        $data = array_intersect_key($data, array_flip($allowed));
        $data['member_id'] = $id;
        $data['status'] = 'pending';
        
        return LoanApplication::create($data);
    }

    public function update(array $data, $id)
    {
        $loan = LoanApplication::find($id);
        $loan->update($data);

        // if ($data['status'] === 'approved') {
        //     return $loan->disbursement()->create(); // Creates the related disbursement with default values
        // }

        return $loan;
    }

    public function delete($id)
    {
        return LoanApplication::find($id)->delete();
    }
}
