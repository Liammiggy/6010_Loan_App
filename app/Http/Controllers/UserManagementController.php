<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\UserManagementService;

class UserManagementController extends Controller
{

    protected UserManagementService $service;

    public function __construct(UserManagementService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = $this->service->getUsers();
        $roles = $this->service->getRoles();
        $permissions = $this->service->getPermissions();

        return view('pages.user-management.index', compact('users', 'roles', 'permissions'));
    }

    public function roles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if($validator->fails()) 
            return response()->json([
                'errors' => $validator->errors()
            ], 422);

        $role = $this->service->getRole($request->id);
        return response()->json($role);
    }

    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'permissions' => 'required|array',
        ]);

        if($validator->fails()) 
            return response()->json([
                'errors' => $validator->errors()
            ], 422);

        $this->service->storeRole($request->all());
        session()->flash('toast', ['type' => 'success', 'message' => 'Role created successfully']);
        return response()->json([], 200);
    }
    

    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'permissions' => 'required|array',
        ]);

        $this->service->updateRole($request->all(), $id);
        session()->flash('toast', ['type' => 'success', 'message' => 'Role updated successfully']);
        return response()->json([], 200);
    }

    public function deleteRole($id)
    {
        $this->service->deleteRole($id);
        session()->flash('toast', ['type' => 'success', 'message' => 'Role deleted successfully']);
        return response()->json([], 200);
    }

    public function users(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if($validator->fails()) 
            return response()->json([
                'errors' => $validator->errors()
            ], 422);

        $user = $this->service->getUser($request->id);
        return response()->json($user);
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer',
        ]);

        if($validator->fails()) 
            return response()->json([
                'errors' => $validator->errors()
            ], 422);

        $this->service->storeUser($request->all());
        session()->flash('toast', ['type' => 'success', 'message' => 'User created successfully']);
        return response()->json([], 200);
    }

    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string',
            'role_id' => 'required|integer',
        ]);

        if($validator->fails()) 
            return response()->json([
                'errors' => $validator->errors()
            ], 422);

        $this->service->updateUser($request->all(), $id);
        session()->flash('toast', ['type' => 'success', 'message' => 'User updated successfully']);
        return response()->json([], 200);
    }

    public function deleteUser($id)
    {
        $this->service->deleteUser($id);
        session()->flash('toast', ['type' => 'success', 'message' => 'User deleted successfully']);
        return response()->json([], 200);
    }
    
}
