<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;

class UserManagementService extends AbstractService
{

    protected string $model = User::class;
    protected bool $showWithRelations = true;
    protected array $customFilters = [];

    public function getUsers(array $filters = [])
    {
        return $this->all($filters)->get();
    }

    public function getRoles(array $filters = [])
    {
        $this->model = Role::class; 
        $this->relations(['users', 'permissions']);
        return $this->all($filters)->paginate(10); 
    }

    public function getPermissions()
    {
        $permissions = \DB::table('permissions')->get();
        
        $descriptions = $permissions->pluck('description')->unique();

        $collection = collect([]);

        foreach ($descriptions as $description) {
            if(empty($collection[$description])) {
                $collection->put($description, collect([]));
            }
            foreach($permissions->where('description', $description) as $permission) {
                $collection[$description]->push($permission);
            }
            
        }

        return $collection;
    }

    public function storeRole(array $data)
    {
        $role = Role::create($data);
        $ids = \DB::table('permissions')->whereIn('slug', $data['permissions'])->pluck('id');
        $role->permissions()->attach($ids);
        return $role;
    }

    public function updateRole(array $data, $id)
    {
        $role = Role::find($id);
        $role->update($data);
        $ids = \DB::table('permissions')->whereIn('slug', $data['permissions'])->pluck('id');
        $role->permissions()->sync($ids);
        return $role;   
    }

    public function getRole($id)
    {
        $this->model = Role::class; 
        $this->relations(['users', 'permissions']);
        return $this->find($id);
    }
}
