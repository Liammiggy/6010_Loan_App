<?php

namespace App\Services;

use App\Models\Member;

class MemberService extends AbstractService
{
    protected string $model = Member::class;
    protected bool $showWithRelations = true;
    protected array $customFilters = [];

    public function getMembers(array $filters = []) 
    {
        return $this->all($filters)->paginate(10);
    }

    public function create(array $data)
    {
        return Member::create($data);
    }

    public function update(array $data, $id)
    {
        return Member::find($id)->update($data);
    }

    public function delete($id)
    {
        return Member::find($id)->delete();
    }

}
