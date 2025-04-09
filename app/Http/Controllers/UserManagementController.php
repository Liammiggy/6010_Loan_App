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
        return redirect()->route('user-management')->with('success', 'Role created successfully'); 
    }

    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'permissions' => 'required|array',
        ]);

        $this->service->updateRole($request->all(), $id);
        return redirect()->route('user-management')->with('success', 'Role updated successfully');
    }
}
