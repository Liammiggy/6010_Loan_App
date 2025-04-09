<div id="roles-panel" class="tab-panel hidden">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="white-space: nowrap;">Users Count</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($roles as $index => $role)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $role['name'] }}</div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($role['permissions'] as $permission)
                                <span class="px-1.5 py-0.5 text-xs rounded-full bg-gray-100 text-gray-800">
                                    {{ $permission['name'] }}
                                </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $role->users->count() }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="editRole({{ $role['id'] }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">Edit</button>
                            <button onclick="deleteRole({{ $role['id'] }})" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{ $roles->appends(['tab' => 'roles'])->links() }}
    </div>
</div>