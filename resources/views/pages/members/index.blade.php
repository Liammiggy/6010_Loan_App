@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Members'])

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
                    @php
                        $members = [
                            ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com', 'phone' => '+63 912 345 6789', 'address' => '123 Main St, Quezon City', 'status' => 'Active', 'join_date' => '2024-01-15'],
                            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'phone' => '+63 923 456 7890', 'address' => '456 Oak Ave, Makati City', 'status' => 'Active', 'join_date' => '2024-02-01'],
                            ['id' => 3, 'name' => 'Michael Johnson', 'email' => 'michael.j@example.com', 'phone' => '+63 934 567 8901', 'address' => '789 Pine St, Manila', 'status' => 'Inactive', 'join_date' => '2024-02-15'],
                            ['id' => 4, 'name' => 'Sarah Williams', 'email' => 'sarah.w@example.com', 'phone' => '+63 945 678 9012', 'address' => '321 Elm St, Pasig City', 'status' => 'Active', 'join_date' => '2024-03-01'],
                            ['id' => 5, 'name' => 'Robert Brown', 'email' => 'robert.b@example.com', 'phone' => '+63 956 789 0123', 'address' => '654 Maple St, Taguig City', 'status' => 'Active', 'join_date' => '2024-03-15'],
                            ['id' => 6, 'name' => 'Emily Davis', 'email' => 'emily.d@example.com', 'phone' => '+63 967 890 1234', 'address' => '987 Cedar St, Mandaluyong', 'status' => 'Inactive', 'join_date' => '2024-04-01'],
                            ['id' => 7, 'name' => 'David Wilson', 'email' => 'david.w@example.com', 'phone' => '+63 978 901 2345', 'address' => '147 Birch St, San Juan', 'status' => 'Active', 'join_date' => '2024-04-15'],
                            ['id' => 8, 'name' => 'Jennifer Taylor', 'email' => 'jennifer.t@example.com', 'phone' => '+63 989 012 3456', 'address' => '258 Spruce St, Pasay City', 'status' => 'Active', 'join_date' => '2024-05-01'],
                            ['id' => 9, 'name' => 'Thomas Anderson', 'email' => 'thomas.a@example.com', 'phone' => '+63 990 123 4567', 'address' => '369 Willow St, Parañaque', 'status' => 'Inactive', 'join_date' => '2024-05-15'],
                            ['id' => 10, 'name' => 'Lisa Martinez', 'email' => 'lisa.m@example.com', 'phone' => '+63 901 234 5678', 'address' => '741 Palm St, Las Piñas', 'status' => 'Active', 'join_date' => '2024-06-01']
                        ];
                    @endphp
                    @foreach($members as $member)
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
                            <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $member['status'] === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $member['status'] }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $member['join_date'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="viewMember({{ $member['id'] }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</button>
                            <button onclick="editMember({{ $member['id'] }})" class="text-indigo-600 hover:text-indigo-900 mr-2 text-sm">Edit</button>
                            <button onclick="deleteMember({{ $member['id'] }})" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
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

    <!-- Add/Edit Member Modal -->
    <div id="memberModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Add New Member</h3>
                <form id="memberForm" class="mt-4">
                    <input type="hidden" id="memberId">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="address" name="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeMemberModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Member Modal -->
    <div id="viewMemberModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900">Member Details</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Full Name</h4>
                        <p id="viewName" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Email</h4>
                        <p id="viewEmail" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Phone Number</h4>
                        <p id="viewPhone" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Address</h4>
                        <p id="viewAddress" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Status</h4>
                        <p id="viewStatus" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Join Date</h4>
                        <p id="viewJoinDate" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button onclick="closeViewMemberModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    // Modal Functions
    function openAddMemberModal() {
        document.getElementById('modalTitle').textContent = 'Add New Member';
        document.getElementById('memberForm').reset();
        document.getElementById('memberId').value = '';
        document.getElementById('memberModal').classList.remove('hidden');
    }

    function closeMemberModal() {
        document.getElementById('memberModal').classList.add('hidden');
    }

    function closeViewMemberModal() {
        document.getElementById('viewMemberModal').classList.add('hidden');
    }

    // Member Functions
    function viewMember(id) {
        const member = members.find(m => m.id === id);
        if (member) {
            document.getElementById('viewName').textContent = member.name;
            document.getElementById('viewEmail').textContent = member.email;
            document.getElementById('viewPhone').textContent = member.phone;
            document.getElementById('viewAddress').textContent = member.address;
            document.getElementById('viewStatus').textContent = member.status;
            document.getElementById('viewJoinDate').textContent = member.join_date;
            document.getElementById('viewMemberModal').classList.remove('hidden');
        }
    }

    function editMember(id) {
        const member = members.find(m => m.id === id);
        if (member) {
            document.getElementById('modalTitle').textContent = 'Edit Member';
            document.getElementById('memberId').value = member.id;
            document.getElementById('name').value = member.name;
            document.getElementById('email').value = member.email;
            document.getElementById('phone').value = member.phone;
            document.getElementById('address').value = member.address;
            document.getElementById('status').value = member.status;
            document.getElementById('memberModal').classList.remove('hidden');
        }
    }

    function deleteMember(id) {
        if (confirm('Are you sure you want to delete this member?')) {
            console.log('Delete member:', id);
            // Implement delete functionality
        }
    }

    // Form Submission
    document.getElementById('memberForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            id: document.getElementById('memberId').value,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value,
            status: document.getElementById('status').value
        };
        console.log('Form submitted:', formData);
        closeMemberModal();
    });

    // Store members data for JavaScript functions
    const members = @json($members);
</script>
@endpush
@endsection


