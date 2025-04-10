<?php

namespace App\Services;

use App\Models\LoanType;

class LoanTypeService extends AbstractService
{
    protected string $model = LoanType::class;
    protected bool $showWithRelations = true;
    protected array $customFilters = [];

    public function getLoanTypes(array $filters = [])
    {
        return $this->all($filters)->paginate(10);
    }

    public function create(array $data)
    {
        return LoanType::create($data);
    }

    public function update(array $data, $id)
    {
        return LoanType::find($id)->update($data);
    }

    public function delete($id)
    {
        return LoanType::find($id)->delete();
    }
}
