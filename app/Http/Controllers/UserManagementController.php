<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = [];
        $roles = [];

        return view('pages.user-management.index', compact('users', 'roles'));
    }
}
