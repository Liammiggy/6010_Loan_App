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
