@extends('layouts.app')

@section('content')
    @include('pages.components.header', ['title' => 'User & Roles Management'])

    <!-- Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <div class="flex justify-between items-center">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button onclick="switchTab('users')" class="tab-button border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600" id="users-tab">
                        Users
                    </button>
                    <button onclick="switchTab('roles')" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" id="roles-tab">
                        Roles
                    </button>
                </nav>
                <!-- User Add Button -->
                <button id="addUserBtn" onclick="openUserModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New User
                </button>
                <!-- Role Add Button (Hidden by default) -->
                <button id="addRoleBtn" onclick="openRoleModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Role
                </button>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div id="users-panel" class="tab-panel">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $users = [
                                ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'role' => 'Administrator', 'status' => 'Active'],
                                ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'role' => 'Loan Officer', 'status' => 'Active'],
                                ['name' => 'Michael Johnson', 'email' => 'michael.j@example.com', 'role' => 'Loan Officer', 'status' => 'Active'],
                                ['name' => 'Sarah Williams', 'email' => 'sarah.w@example.com', 'role' => 'Loan Officer', 'status' => 'Inactive'],
                                ['name' => 'Robert Brown', 'email' => 'robert.b@example.com', 'role' => 'Loan Officer', 'status' => 'Active'],
                                ['name' => 'Emily Davis', 'email' => 'emily.d@example.com', 'role' => 'Loan Officer', 'status' => 'Active'],
                                ['name' => 'David Wilson', 'email' => 'david.w@example.com', 'role' => 'Loan Officer', 'status' => 'Inactive'],
                                ['name' => 'Jennifer Taylor', 'email' => 'jennifer.t@example.com', 'role' => 'Loan Officer', 'status' => 'Active'],
                                ['name' => 'Thomas Anderson', 'email' => 'thomas.a@example.com', 'role' => 'Loan Officer', 'status' => 'Active'],
                                ['name' => 'Lisa Martinez', 'email' => 'lisa.m@example.com', 'role' => 'Loan Officer', 'status' => 'Active']
                            ];
                        @endphp
                        @foreach($users as $index => $user)
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-7 w-7">
                                        <img class="h-7 w-7 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $user['name'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user['email'] }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user['role'] === 'Administrator' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ $user['role'] }}
                                </span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user['status'] === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user['status'] }}
                                </span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="editUser({{ $index + 1 }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">Edit</button>
                                <button onclick="deleteUser({{ $index + 1 }})" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </a>
                    <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </a>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">10</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                1
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                2
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                3
                            </a>
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Roles Table -->
    <div id="roles-panel" class="tab-panel hidden">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Users Count</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $roles = [
                                [
                                    'name' => 'Administrator',
                                    'permissions' => ['All Permissions'],
                                    'users_count' => 1
                                ],
                                [
                                    'name' => 'Loan Officer',
                                    'permissions' => ['View Members', 'View Loans', 'Process Loans'],
                                    'users_count' => 8
                                ],
                                [
                                    'name' => 'Loan Processor',
                                    'permissions' => ['View Loans', 'Process Loans'],
                                    'users_count' => 2
                                ],
                                [
                                    'name' => 'Loan Approver',
                                    'permissions' => ['View Loans', 'Approve Loans'],
                                    'users_count' => 3
                                ],
                                [
                                    'name' => 'Member Service',
                                    'permissions' => ['View Members', 'Add Members', 'Edit Members'],
                                    'users_count' => 4
                                ],
                                [
                                    'name' => 'Accountant',
                                    'permissions' => ['View Loans', 'View Payments', 'Process Payments'],
                                    'users_count' => 2
                                ],
                                [
                                    'name' => 'Auditor',
                                    'permissions' => ['View All', 'Generate Reports'],
                                    'users_count' => 1
                                ],
                                [
                                    'name' => 'Branch Manager',
                                    'permissions' => ['View All', 'Manage Staff', 'Approve Loans'],
                                    'users_count' => 2
                                ],
                                [
                                    'name' => 'IT Support',
                                    'permissions' => ['System Maintenance', 'User Management'],
                                    'users_count' => 1
                                ],
                                [
                                    'name' => 'Customer Service',
                                    'permissions' => ['View Members', 'View Loans', 'Basic Support'],
                                    'users_count' => 3
                                ]
                            ];
                        @endphp
                        @foreach($roles as $index => $role)
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $role['name'] }}</div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($role['permissions'] as $permission)
                                    <span class="px-1.5 py-0.5 text-xs rounded-full bg-gray-100 text-gray-800">
                                        {{ $permission }}
                                    </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $role['users_count'] }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="editRole({{ $index + 1 }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">Edit</button>
                                <button onclick="deleteRole({{ $index + 1 }})" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="bg-white px-3 py-2 flex items-center justify-between border-t border-gray-200 sm:px-4">
                <div class="flex-1 flex justify-between sm:hidden">
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </a>
                    <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </a>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">10</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                1
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                2
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                3
                            </a>
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Modal -->
    <div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900" id="modal-title">Add New User</h3>
                <form id="userForm" class="mt-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Name
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Full Name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                            Role
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role">
                            <option value="">Select Role</option>
                            @php
                                $roles = [
                                    ['id' => 1, 'name' => 'Administrator'],
                                    ['id' => 2, 'name' => 'Loan Officer'],
                                    ['id' => 3, 'name' => 'Loan Processor'],
                                    ['id' => 4, 'name' => 'Loan Approver'],
                                    ['id' => 5, 'name' => 'Member Service'],
                                    ['id' => 6, 'name' => 'Accountant'],
                                    ['id' => 7, 'name' => 'Auditor'],
                                    ['id' => 8, 'name' => 'Branch Manager'],
                                    ['id' => 9, 'name' => 'IT Support'],
                                    ['id' => 10, 'name' => 'Customer Service']
                                ];
                            @endphp
                            @foreach($roles as $role)
                            <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Password">
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="button" onclick="closeUserModal()" class="mr-3 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Role Modal -->
    <div id="roleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900" id="role-modal-title">Add New Role</h3>
                <form id="roleForm" class="mt-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="role_name">
                            Role Name
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role_name" type="text" placeholder="Role Name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Permissions
                        </label>
                        <div class="space-y-4 max-h-96 overflow-y-auto p-4">
                            <!-- User & Role Management -->
                            <div class="border-b pb-3">
                                <h4 class="font-medium text-gray-900 mb-2">User & Role Management</h4>
                                <div class="space-y-2 ml-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_users_view" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_users_view" class="ml-2 text-sm text-gray-700">View Users</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_users_create" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_users_create" class="ml-2 text-sm text-gray-700">Create Users</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_users_edit" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_users_edit" class="ml-2 text-sm text-gray-700">Edit Users</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_users_delete" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_users_delete" class="ml-2 text-sm text-gray-700">Delete Users</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_roles_manage" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_roles_manage" class="ml-2 text-sm text-gray-700">Manage Roles & Permissions</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Member Management -->
                            <div class="border-b pb-3">
                                <h4 class="font-medium text-gray-900 mb-2">Member Management</h4>
                                <div class="space-y-2 ml-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_members_view" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_members_view" class="ml-2 text-sm text-gray-700">View Members</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_members_create" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_members_create" class="ml-2 text-sm text-gray-700">Add Members</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_members_edit" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_members_edit" class="ml-2 text-sm text-gray-700">Edit Members</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_members_status" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_members_status" class="ml-2 text-sm text-gray-700">Activate/Deactivate Members</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_members_history" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_members_history" class="ml-2 text-sm text-gray-700">View Loan History</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Loan Type Management -->
                            <div class="border-b pb-3">
                                <h4 class="font-medium text-gray-900 mb-2">Loan Type Management</h4>
                                <div class="space-y-2 ml-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_types_view" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_types_view" class="ml-2 text-sm text-gray-700">View Loan Types</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_types_create" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_types_create" class="ml-2 text-sm text-gray-700">Create Loan Types</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_types_edit" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_types_edit" class="ml-2 text-sm text-gray-700">Edit Loan Types</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_types_delete" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_types_delete" class="ml-2 text-sm text-gray-700">Delete Loan Types</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Loan Application -->
                            <div class="border-b pb-3">
                                <h4 class="font-medium text-gray-900 mb-2">Loan Application</h4>
                                <div class="space-y-2 ml-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_apps_view" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_apps_view" class="ml-2 text-sm text-gray-700">View Applications</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_apps_create" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_apps_create" class="ml-2 text-sm text-gray-700">Create Applications</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_apps_verify" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_apps_verify" class="ml-2 text-sm text-gray-700">Verify Applications</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_apps_approve" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_apps_approve" class="ml-2 text-sm text-gray-700">Approve/Reject Applications</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_docs_manage" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_docs_manage" class="ml-2 text-sm text-gray-700">Manage Documents</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Disbursement & Repayment -->
                            <div class="border-b pb-3">
                                <h4 class="font-medium text-gray-900 mb-2">Disbursement & Repayment</h4>
                                <div class="space-y-2 ml-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_disburse" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_disburse" class="ml-2 text-sm text-gray-700">Disburse Loans</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_repayment_schedule" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_repayment_schedule" class="ml-2 text-sm text-gray-700">Manage Repayment Schedules</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_loan_status" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_loan_status" class="ml-2 text-sm text-gray-700">Update Loan Status</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment & Transaction -->
                            <div class="pb-3">
                                <h4 class="font-medium text-gray-900 mb-2">Payment & Transaction</h4>
                                <div class="space-y-2 ml-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_payments_record" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_payments_record" class="ml-2 text-sm text-gray-700">Record Payments</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_payments_view" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_payments_view" class="ml-2 text-sm text-gray-700">View Transactions</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_fees_manage" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_fees_manage" class="ml-2 text-sm text-gray-700">Manage Fees & Penalties</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perm_balance_adjust" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <label for="perm_balance_adjust" class="ml-2 text-sm text-gray-700">Adjust Balances</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="button" onclick="closeRoleModal()" class="mr-3 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    function switchTab(tab) {
        // Hide all panels
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.add('hidden');
        });
        
        // Show selected panel
        document.getElementById(`${tab}-panel`).classList.remove('hidden');
        
        // Update tab styles
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('border-blue-500', 'text-blue-600');
            button.classList.add('border-transparent', 'text-gray-500');
        });
        
        document.getElementById(`${tab}-tab`).classList.add('border-blue-500', 'text-blue-600');
        document.getElementById(`${tab}-tab`).classList.remove('border-transparent', 'text-gray-500');

        // Toggle add buttons based on active tab
        const addUserBtn = document.getElementById('addUserBtn');
        const addRoleBtn = document.getElementById('addRoleBtn');
        
        if (tab === 'roles') {
            addUserBtn.classList.add('hidden');
            addRoleBtn.classList.remove('hidden');
        } else {
            addUserBtn.classList.remove('hidden');
            addRoleBtn.classList.add('hidden');
        }
    }

    function openUserModal() {
        document.getElementById('userModal').classList.remove('hidden');
    }

    function closeUserModal() {
        document.getElementById('userModal').classList.add('hidden');
    }

    function editUser(userId) {
        // Implement edit user logic
        openUserModal();
        // Fetch user data and populate form
    }

    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            // Implement delete user logic
        }
    }

    function openRoleModal() {
        document.getElementById('roleModal').classList.remove('hidden');
        document.getElementById('role-modal-title').textContent = 'Add New Role';
        document.getElementById('roleForm').reset();
    }

    function closeRoleModal() {
        document.getElementById('roleModal').classList.add('hidden');
    }

    function editRole(roleId) {
        openRoleModal();
        document.getElementById('role-modal-title').textContent = 'Edit Role';
        
        // Fetch role data and populate form
        fetch(`/api/roles/${roleId}`)
            .then(response => response.json())
            .then(role => {
                document.getElementById('role_name').value = role.name;
                // Populate permissions
                role.permissions.forEach(permission => {
                    const checkbox = document.getElementById(`perm_${permission}`);
                    if (checkbox) checkbox.checked = true;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    function deleteRole(roleId) {
        if (confirm('Are you sure you want to delete this role? This action cannot be undone.')) {
            fetch(`/api/roles/${roleId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    throw new Error('Failed to delete role');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete role. Please try again.');
            });
        }
    }

    // Handle role form submission
    document.getElementById('roleForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            name: document.getElementById('role_name').value,
            permissions: Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
                .map(checkbox => checkbox.id.replace('perm_', ''))
        };

        const isEdit = document.getElementById('role-modal-title').textContent === 'Edit Role';
        const url = isEdit ? `/api/roles/${roleId}` : '/api/roles';
        const method = isEdit ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                throw new Error('Failed to save role');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to save role. Please try again.');
        });
    });

    // Close modals when clicking outside
    window.onclick = function(event) {
        const userModal = document.getElementById('userModal');
        const roleModal = document.getElementById('roleModal');
        
        if (event.target == userModal) {
            closeUserModal();
        }
        if (event.target == roleModal) {
            closeRoleModal();
        }
    }
</script>
@endpush
@endsection


