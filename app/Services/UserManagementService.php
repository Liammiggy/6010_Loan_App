<?php

namespace App\Services;

use App\Models\{User, Role, Permission};

class UserManagementService extends AbstractService
{

    protected string $model = User::class;
    protected bool $showWithRelations = true;
    protected array $customFilters = [];

    public function getUsers(array $filters = [])
    {
        $this->model = User::class;
        $this->relations(['roles']);
        return $this->all($filters)->paginate(10);
    }

    public function getRoles(array $filters = [])
    {
        $this->model = Role::class; 
        $this->relations(['users', 'permissions']);
        return $this->all($filters)->paginate(10); 
    }

    public function getPermissions()
    { 
        $permissions = new Permission();
        $modules = $permissions->getModules();
        
        $collection = collect([]);

        foreach ($modules as $key =>$module) {
            if(empty($collection[$module])) {
                $collection->put($module, collect([]));
            }

            foreach($permissions->where('module', $key)->get() as $permission) {
                $collection[$module]->push($permission);
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

    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();
        return $role;
    }

    public function getUser($id)
    {
        $this->model = User::class;
        $this->relations(['roles']);
        return $this->find($id);
    }   

    public function storeUser(array $data)
    {   
        $user = User::create($data);
        $user->roles()->attach($data['role_id']);
        return $user;
    }

    public function updateUser(array $data, $id)
    {
        $user = User::find($id);
        $user->update($data);
        $user->roles()->sync($data['role_id']);
        return $user;
    }   

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }
}
