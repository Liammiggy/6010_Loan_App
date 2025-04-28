<div id="users-panel" class="tab-panel">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    
                    @foreach($users as $index => $user)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">{{ $user['name'] }}</div>
                            </div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $user['username'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user['role'] === 'Administrator' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                {{ $user->roles[0]->name }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user['is_active'] ? 'Active' : 'Inactive'}}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="editUser({{ $user->id }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">Edit</button>
                            <button onclick="deleteUser({{ $user->id }})" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        {{
            $users->links()
        }}
    </div>
</div>