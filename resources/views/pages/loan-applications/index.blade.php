@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Loan Applications'])

    <!-- Add Loan Application Button -->
    <div class="mb-6">
        <button onclick="openAddLoanApplicationModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            New Loan Application
        </button>
    </div>

    <!-- Loan Applications Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Application ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loan Type</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Term</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Applied</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $loanApplications = [
                            ['id' => 1, 'application_id' => 'APP-2024-001', 'member' => 'John Doe', 'loan_type' => 'Personal Loan', 'amount' => '₱50,000', 'term' => '12 months', 'status' => 'Pending', 'date_applied' => '2024-03-15'],
                            ['id' => 2, 'application_id' => 'APP-2024-002', 'member' => 'Jane Smith', 'loan_type' => 'Business Loan', 'amount' => '₱200,000', 'term' => '24 months', 'status' => 'Approved', 'date_applied' => '2024-03-14'],
                            ['id' => 3, 'application_id' => 'APP-2024-003', 'member' => 'Robert Johnson', 'loan_type' => 'Emergency Loan', 'amount' => '₱20,000', 'term' => '6 months', 'status' => 'Rejected', 'date_applied' => '2024-03-13'],
                            ['id' => 4, 'application_id' => 'APP-2024-004', 'member' => 'Maria Garcia', 'loan_type' => 'Education Loan', 'amount' => '₱100,000', 'term' => '36 months', 'status' => 'Pending', 'date_applied' => '2024-03-12'],
                            ['id' => 5, 'application_id' => 'APP-2024-005', 'member' => 'Michael Brown', 'loan_type' => 'Housing Loan', 'amount' => '₱500,000', 'term' => '60 months', 'status' => 'Approved', 'date_applied' => '2024-03-11'],
                            ['id' => 6, 'application_id' => 'APP-2024-006', 'member' => 'Sarah Wilson', 'loan_type' => 'Vehicle Loan', 'amount' => '₱300,000', 'term' => '48 months', 'status' => 'Pending', 'date_applied' => '2024-03-10'],
                            ['id' => 7, 'application_id' => 'APP-2024-007', 'member' => 'David Lee', 'loan_type' => 'Agricultural Loan', 'amount' => '₱150,000', 'term' => '24 months', 'status' => 'Approved', 'date_applied' => '2024-03-09'],
                            ['id' => 8, 'application_id' => 'APP-2024-008', 'member' => 'Lisa Chen', 'loan_type' => 'Medical Loan', 'amount' => '₱75,000', 'term' => '12 months', 'status' => 'Rejected', 'date_applied' => '2024-03-08'],
                            ['id' => 9, 'application_id' => 'APP-2024-009', 'member' => 'James Taylor', 'loan_type' => 'Renovation Loan', 'amount' => '₱250,000', 'term' => '36 months', 'status' => 'Pending', 'date_applied' => '2024-03-07'],
                            ['id' => 10, 'application_id' => 'APP-2024-010', 'member' => 'Emily Davis', 'loan_type' => 'Equipment Loan', 'amount' => '₱400,000', 'term' => '24 months', 'status' => 'Approved', 'date_applied' => '2024-03-06']
                        ];
                    @endphp
                    @foreach($loanApplications as $application)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $application['application_id'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $application['member'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $application['loan_type'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $application['amount'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $application['term'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'Approved' => 'bg-green-100 text-green-800',
                                    'Rejected' => 'bg-red-100 text-red-800'
                                ];
                            @endphp
                            <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$application['status']] }}">
                                {{ $application['status'] }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ date('M d, Y', strtotime($application['date_applied'])) }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="viewApplication({{ $application['id'] }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</button>
                            <button onclick="processApplication({{ $application['id'] }})" class="text-indigo-600 hover:text-indigo-900 mr-2 text-sm">Process</button>
                            <button onclick="deleteApplication({{ $application['id'] }})" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
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

    <!-- Add/Edit Loan Application Modal -->
    <div id="loanApplicationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">New Loan Application</h3>
                <form id="loanApplicationForm" class="mt-4">
                    <input type="hidden" id="applicationId">
                    <div class="mb-4">
                        <label for="member" class="block text-sm font-medium text-gray-700">Member</label>
                        <select id="member" name="member" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">Select Member</option>
                            <option value="1">John Doe</option>
                            <option value="2">Jane Smith</option>
                            <option value="3">Robert Johnson</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="loan_type" class="block text-sm font-medium text-gray-700">Loan Type</label>
                        <select id="loan_type" name="loan_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">Select Loan Type</option>
                            <option value="1">Personal Loan</option>
                            <option value="2">Business Loan</option>
                            <option value="3">Emergency Loan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount (₱)</label>
                        <input type="number" id="amount" name="amount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="term" class="block text-sm font-medium text-gray-700">Term (Months)</label>
                        <input type="number" id="term" name="term" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
                        <textarea id="purpose" name="purpose" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeLoanApplicationModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Loan Application Modal -->
    <div id="viewApplicationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900">Loan Application Details</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Application ID</h4>
                        <p id="viewApplicationId" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Member</h4>
                        <p id="viewMember" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Loan Type</h4>
                        <p id="viewLoanType" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Amount</h4>
                        <p id="viewAmount" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Term</h4>
                        <p id="viewTerm" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Purpose</h4>
                        <p id="viewPurpose" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Status</h4>
                        <p id="viewStatus" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Date Applied</h4>
                        <p id="viewDateApplied" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button onclick="closeViewApplicationModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Application Modal -->
    <div id="processApplicationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900">Process Loan Application</h3>
                <form id="processApplicationForm" class="mt-4">
                    <input type="hidden" id="processApplicationId">
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                        <textarea id="remarks" name="remarks" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeProcessApplicationModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    // Modal Functions
    function openAddLoanApplicationModal() {
        document.getElementById('modalTitle').textContent = 'New Loan Application';
        document.getElementById('loanApplicationForm').reset();
        document.getElementById('applicationId').value = '';
        document.getElementById('loanApplicationModal').classList.remove('hidden');
    }

    function closeLoanApplicationModal() {
        document.getElementById('loanApplicationModal').classList.add('hidden');
    }

    function closeViewApplicationModal() {
        document.getElementById('viewApplicationModal').classList.add('hidden');
    }

    function closeProcessApplicationModal() {
        document.getElementById('processApplicationModal').classList.add('hidden');
    }

    // Application Functions
    function viewApplication(id) {
        const application = loanApplications.find(app => app.id === id);
        if (application) {
            document.getElementById('viewApplicationId').textContent = application.application_id;
            document.getElementById('viewMember').textContent = application.member;
            document.getElementById('viewLoanType').textContent = application.loan_type;
            document.getElementById('viewAmount').textContent = application.amount;
            document.getElementById('viewTerm').textContent = application.term;
            document.getElementById('viewPurpose').textContent = 'For personal use'; // Dummy purpose
            document.getElementById('viewStatus').textContent = application.status;
            document.getElementById('viewDateApplied').textContent = new Date(application.date_applied).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            document.getElementById('viewApplicationModal').classList.remove('hidden');
        }
    }

    function processApplication(id) {
        const application = loanApplications.find(app => app.id === id);
        if (application) {
            document.getElementById('processApplicationId').value = id;
            document.getElementById('status').value = application.status;
            document.getElementById('remarks').value = '';
            document.getElementById('processApplicationModal').classList.remove('hidden');
        }
    }

    function deleteApplication(id) {
        if (confirm('Are you sure you want to delete this loan application?')) {
            console.log('Delete application:', id);
            // Implement delete functionality
        }
    }

    // Form Submissions
    document.getElementById('loanApplicationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            member: document.getElementById('member').value,
            loan_type: document.getElementById('loan_type').value,
            amount: document.getElementById('amount').value,
            term: document.getElementById('term').value,
            purpose: document.getElementById('purpose').value
        };
        console.log('Form submitted:', formData);
        closeLoanApplicationModal();
    });

    document.getElementById('processApplicationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            id: document.getElementById('processApplicationId').value,
            status: document.getElementById('status').value,
            remarks: document.getElementById('remarks').value
        };
        console.log('Process form submitted:', formData);
        closeProcessApplicationModal();
    });

    // Store applications data for JavaScript functions
    const loanApplications = @json($loanApplications);
</script>
@endpush
@endsection


