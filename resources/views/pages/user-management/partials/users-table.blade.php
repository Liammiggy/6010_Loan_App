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
                <a href="{{ request()->fullUrlWithQuery(['page' => max(1, request()->get('page', 1) - 1), 'tab' => 'users']) }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </a>
                <a href="{{ request()->fullUrlWithQuery(['page' => request()->get('page', 1) + 1, 'tab' => 'users']) }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
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
                        <a href="{{ request()->fullUrlWithQuery(['page' => max(1, request()->get('page', 1) - 1), 'tab' => 'users']) }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['page' => 1, 'tab' => 'users']) }}" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            1
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['page' => 2, 'tab' => 'users']) }}" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            2
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['page' => 3, 'tab' => 'users']) }}" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            3
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['page' => request()->get('page', 1) + 1, 'tab' => 'users']) }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
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