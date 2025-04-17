<!-- Add Member Button -->
<div class="mb-6">
    <button onclick="openAddMemberModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Add New Member
    </button>
</div>

<!-- Members Table -->
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Join Date</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($members as $member)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-7 w-7">
                                <img class="h-7 w-7 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($member['name']) }}" alt="">
                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">{{ $member['name'] }}</div>
                                <div class="text-xs text-gray-500">{{ $member['email'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $member['phone'] }}</div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="text-sm text-gray-900">{{ $member['address'] }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $member['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $member['is_active'] ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ date('m/d/Y', strtotime($member['created_at'])) }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                        <button onclick="viewMember({{ $member['id'] }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</button>
                        <button onclick="editMember({{ $member['id'] }})" class="text-indigo-600 hover:text-indigo-900 mr-2 text-sm">Edit</button>
                        <button onclick="deleteMember({{ $member['id'] }})" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap" colspan="6" style="text-align:center"> No Members to show </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{
        $members->links()
    }}
</div>