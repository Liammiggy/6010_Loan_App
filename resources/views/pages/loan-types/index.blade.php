@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Loan Types'])

    <!-- Add Loan Type Button -->
    <div class="mb-6">
        <button onclick="openAddLoanTypeModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Loan Type
        </button>
    </div>

    <!-- Loan Types Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interest Rate</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Term (Months)</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Max Amount</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $loanTypes = [
                            ['id' => 1, 'name' => 'Personal Loan', 'description' => 'For personal expenses and emergencies', 'interest_rate' => '12%', 'term' => '12', 'max_amount' => '₱50,000', 'status' => 'Active'],
                            ['id' => 2, 'name' => 'Business Loan', 'description' => 'For small business capital and expansion', 'interest_rate' => '15%', 'term' => '24', 'max_amount' => '₱200,000', 'status' => 'Active'],
                            ['id' => 3, 'name' => 'Emergency Loan', 'description' => 'Quick access to funds for emergencies', 'interest_rate' => '10%', 'term' => '6', 'max_amount' => '₱20,000', 'status' => 'Active'],
                            ['id' => 4, 'name' => 'Education Loan', 'description' => 'For educational expenses and tuition', 'interest_rate' => '8%', 'term' => '36', 'max_amount' => '₱100,000', 'status' => 'Active'],
                            ['id' => 5, 'name' => 'Housing Loan', 'description' => 'For home improvement and repairs', 'interest_rate' => '9%', 'term' => '60', 'max_amount' => '₱500,000', 'status' => 'Active'],
                            ['id' => 6, 'name' => 'Vehicle Loan', 'description' => 'For vehicle purchase and maintenance', 'interest_rate' => '14%', 'term' => '48', 'max_amount' => '₱300,000', 'status' => 'Inactive'],
                            ['id' => 7, 'name' => 'Agricultural Loan', 'description' => 'For farming equipment and supplies', 'interest_rate' => '7%', 'term' => '24', 'max_amount' => '₱150,000', 'status' => 'Active'],
                            ['id' => 8, 'name' => 'Medical Loan', 'description' => 'For medical expenses and treatments', 'interest_rate' => '11%', 'term' => '12', 'max_amount' => '₱75,000', 'status' => 'Active'],
                            ['id' => 9, 'name' => 'Renovation Loan', 'description' => 'For home and property renovations', 'interest_rate' => '13%', 'term' => '36', 'max_amount' => '₱250,000', 'status' => 'Active'],
                            ['id' => 10, 'name' => 'Equipment Loan', 'description' => 'For business equipment purchase', 'interest_rate' => '16%', 'term' => '24', 'max_amount' => '₱400,000', 'status' => 'Inactive']
                        ];
                    @endphp
                    @foreach($loanTypes as $loanType)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $loanType['name'] }}</div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="text-sm text-gray-900">{{ $loanType['description'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $loanType['interest_rate'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $loanType['term'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $loanType['max_amount'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $loanType['status'] === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $loanType['status'] }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="viewLoanType({{ $loanType['id'] }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</button>
                            <button onclick="editLoanType({{ $loanType['id'] }})" class="text-indigo-600 hover:text-indigo-900 mr-2 text-sm">Edit</button>
                            <button onclick="deleteLoanType({{ $loanType['id'] }})" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
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

    <!-- Add/Edit Loan Type Modal -->
    <div id="loanTypeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Add New Loan Type</h3>
                <form id="loanTypeForm" class="mt-4">
                    <input type="hidden" id="loanTypeId">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="interest_rate" class="block text-sm font-medium text-gray-700">Interest Rate (%)</label>
                        <input type="number" step="0.01" id="interest_rate" name="interest_rate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="term" class="block text-sm font-medium text-gray-700">Term (Months)</label>
                        <input type="number" id="term" name="term" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="max_amount" class="block text-sm font-medium text-gray-700">Maximum Amount (₱)</label>
                        <input type="number" id="max_amount" name="max_amount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeLoanTypeModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
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

    <!-- View Loan Type Modal -->
    <div id="viewLoanTypeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900">Loan Type Details</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Name</h4>
                        <p id="viewName" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Description</h4>
                        <p id="viewDescription" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Interest Rate</h4>
                        <p id="viewInterestRate" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Term</h4>
                        <p id="viewTerm" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Maximum Amount</h4>
                        <p id="viewMaxAmount" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Status</h4>
                        <p id="viewStatus" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button onclick="closeViewLoanTypeModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    // Modal Functions
    function openAddLoanTypeModal() {
        document.getElementById('modalTitle').textContent = 'Add New Loan Type';
        document.getElementById('loanTypeForm').reset();
        document.getElementById('loanTypeId').value = '';
        document.getElementById('loanTypeModal').classList.remove('hidden');
    }

    function closeLoanTypeModal() {
        document.getElementById('loanTypeModal').classList.add('hidden');
    }

    function closeViewLoanTypeModal() {
        document.getElementById('viewLoanTypeModal').classList.add('hidden');
    }

    // Loan Type Functions
    function viewLoanType(id) {
        const loanType = loanTypes.find(lt => lt.id === id);
        if (loanType) {
            document.getElementById('viewName').textContent = loanType.name;
            document.getElementById('viewDescription').textContent = loanType.description;
            document.getElementById('viewInterestRate').textContent = loanType.interest_rate;
            document.getElementById('viewTerm').textContent = loanType.term + ' months';
            document.getElementById('viewMaxAmount').textContent = loanType.max_amount;
            document.getElementById('viewStatus').textContent = loanType.status;
            document.getElementById('viewLoanTypeModal').classList.remove('hidden');
        }
    }

    function editLoanType(id) {
        const loanType = loanTypes.find(lt => lt.id === id);
        if (loanType) {
            document.getElementById('modalTitle').textContent = 'Edit Loan Type';
            document.getElementById('loanTypeId').value = loanType.id;
            document.getElementById('name').value = loanType.name;
            document.getElementById('description').value = loanType.description;
            document.getElementById('interest_rate').value = parseFloat(loanType.interest_rate);
            document.getElementById('term').value = loanType.term;
            document.getElementById('max_amount').value = parseFloat(loanType.max_amount.replace('₱', '').replace(',', ''));
            document.getElementById('status').value = loanType.status;
            document.getElementById('loanTypeModal').classList.remove('hidden');
        }
    }

    function deleteLoanType(id) {
        if (confirm('Are you sure you want to delete this loan type?')) {
            console.log('Delete loan type:', id);
            // Implement delete functionality
        }
    }

    // Form Submission
    document.getElementById('loanTypeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            id: document.getElementById('loanTypeId').value,
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            interest_rate: document.getElementById('interest_rate').value + '%',
            term: document.getElementById('term').value,
            max_amount: '₱' + parseFloat(document.getElementById('max_amount').value).toLocaleString(),
            status: document.getElementById('status').value
        };
        console.log('Form submitted:', formData);
        closeLoanTypeModal();
    });

    // Store loan types data for JavaScript functions
    const loanTypes = @json($loanTypes);
</script>
@endpush
@endsection


