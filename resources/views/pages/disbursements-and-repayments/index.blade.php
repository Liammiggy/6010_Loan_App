@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Disbursements and Repayments'])

    <!-- Tabs Navigation -->
    <div class="mb-6 flex justify-between items-center">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button onclick="switchTab('disbursements')" id="disbursementsTab" class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Disbursements
                </button>
                <button onclick="switchTab('repayments')" id="repaymentsTab" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Repayments
                </button>
            </nav>
        </div>
        <div>
            <button onclick="openAddDisbursementModal()" id="addDisbursementBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                New Disbursement
            </button>
            <button onclick="openAddRepaymentModal()" id="addRepaymentBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                New Repayment
            </button>
        </div>
    </div>

    <!-- Disbursements Table -->
    <div id="disbursementsTable" class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disbursement ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loan Type</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Disbursed</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $disbursements = [
                            ['id' => 1, 'disbursement_id' => 'DIS-2024-001', 'member' => 'John Doe', 'loan_type' => 'Personal Loan', 'amount' => '₱50,000', 'date_disbursed' => '2024-03-15', 'status' => 'Completed'],
                            ['id' => 2, 'disbursement_id' => 'DIS-2024-002', 'member' => 'Jane Smith', 'loan_type' => 'Business Loan', 'amount' => '₱200,000', 'date_disbursed' => '2024-03-14', 'status' => 'Completed'],
                            ['id' => 3, 'disbursement_id' => 'DIS-2024-003', 'member' => 'Robert Johnson', 'loan_type' => 'Emergency Loan', 'amount' => '₱20,000', 'date_disbursed' => '2024-03-13', 'status' => 'Pending'],
                            ['id' => 4, 'disbursement_id' => 'DIS-2024-004', 'member' => 'Maria Garcia', 'loan_type' => 'Education Loan', 'amount' => '₱100,000', 'date_disbursed' => '2024-03-12', 'status' => 'Completed'],
                            ['id' => 5, 'disbursement_id' => 'DIS-2024-005', 'member' => 'Michael Brown', 'loan_type' => 'Housing Loan', 'amount' => '₱500,000', 'date_disbursed' => '2024-03-11', 'status' => 'Completed']
                        ];
                    @endphp
                    @foreach($disbursements as $disbursement)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $disbursement['disbursement_id'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $disbursement['member'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $disbursement['loan_type'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $disbursement['amount'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ date('M d, Y', strtotime($disbursement['date_disbursed'])) }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'Completed' => 'bg-green-100 text-green-800',
                                    'Pending' => 'bg-yellow-100 text-yellow-800'
                                ];
                            @endphp
                            <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$disbursement['status']] }}">
                                {{ $disbursement['status'] }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="viewDisbursement({{ $disbursement['id'] }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</button>
                            <button onclick="processDisbursement({{ $disbursement['id'] }})" class="text-indigo-600 hover:text-indigo-900 mr-2 text-sm">Process</button>
                            <button onclick="printDisbursement({{ $disbursement['id'] }})" class="text-gray-600 hover:text-gray-900 text-sm">Print</button>
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
                        Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">5</span> results
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

    <!-- Repayments Table -->
    <div id="repaymentsTable" class="bg-white shadow-md rounded-lg overflow-hidden hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Repayment ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loan Type</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $repayments = [
                            ['id' => 1, 'repayment_id' => 'REP-2024-001', 'member' => 'John Doe', 'loan_type' => 'Personal Loan', 'amount' => '₱4,500', 'due_date' => '2024-04-15', 'status' => 'Pending'],
                            ['id' => 2, 'repayment_id' => 'REP-2024-002', 'member' => 'Jane Smith', 'loan_type' => 'Business Loan', 'amount' => '₱8,500', 'due_date' => '2024-04-14', 'status' => 'Paid'],
                            ['id' => 3, 'repayment_id' => 'REP-2024-003', 'member' => 'Robert Johnson', 'loan_type' => 'Emergency Loan', 'amount' => '₱3,500', 'due_date' => '2024-04-13', 'status' => 'Overdue'],
                            ['id' => 4, 'repayment_id' => 'REP-2024-004', 'member' => 'Maria Garcia', 'loan_type' => 'Education Loan', 'amount' => '₱3,000', 'due_date' => '2024-04-12', 'status' => 'Pending'],
                            ['id' => 5, 'repayment_id' => 'REP-2024-005', 'member' => 'Michael Brown', 'loan_type' => 'Housing Loan', 'amount' => '₱8,500', 'due_date' => '2024-04-11', 'status' => 'Paid']
                        ];
                    @endphp
                    @foreach($repayments as $repayment)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $repayment['repayment_id'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $repayment['member'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $repayment['loan_type'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $repayment['amount'] }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ date('M d, Y', strtotime($repayment['due_date'])) }}</div>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'Paid' => 'bg-green-100 text-green-800',
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'Overdue' => 'bg-red-100 text-red-800'
                                ];
                            @endphp
                            <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$repayment['status']] }}">
                                {{ $repayment['status'] }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="viewRepayment({{ $repayment['id'] }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</button>
                            <button onclick="processRepayment({{ $repayment['id'] }})" class="text-indigo-600 hover:text-indigo-900 mr-2 text-sm">Process</button>
                            <button onclick="printRepayment({{ $repayment['id'] }})" class="text-gray-600 hover:text-gray-900 text-sm">Print</button>
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
                        Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">5</span> results
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

    <!-- Add/Edit Disbursement Modal -->
    <div id="disbursementModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900" id="disbursementModalTitle">New Disbursement</h3>
                <form id="disbursementForm" class="mt-4">
                    <input type="hidden" id="disbursementId">
                    <div class="mb-4">
                        <label for="disbursement_loan" class="block text-sm font-medium text-gray-700">Loan Application</label>
                        <select id="disbursement_loan" name="disbursement_loan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">Select Loan Application</option>
                            <option value="1">APP-2024-001 - John Doe (Personal Loan)</option>
                            <option value="2">APP-2024-002 - Jane Smith (Business Loan)</option>
                            <option value="3">APP-2024-003 - Robert Johnson (Emergency Loan)</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="disbursement_amount" class="block text-sm font-medium text-gray-700">Amount (₱)</label>
                        <input type="number" id="disbursement_amount" name="disbursement_amount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="disbursement_date" class="block text-sm font-medium text-gray-700">Disbursement Date</label>
                        <input type="date" id="disbursement_date" name="disbursement_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="disbursement_method" class="block text-sm font-medium text-gray-700">Disbursement Method</label>
                        <select id="disbursement_method" name="disbursement_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="Check">Check</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="disbursement_notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea id="disbursement_notes" name="disbursement_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeDisbursementModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
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

    <!-- Add/Edit Repayment Modal -->
    <div id="repaymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900" id="repaymentModalTitle">New Repayment</h3>
                <form id="repaymentForm" class="mt-4">
                    <input type="hidden" id="repaymentId">
                    <div class="mb-4">
                        <label for="repayment_loan" class="block text-sm font-medium text-gray-700">Loan</label>
                        <select id="repayment_loan" name="repayment_loan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">Select Loan</option>
                            <option value="1">DIS-2024-001 - John Doe (Personal Loan)</option>
                            <option value="2">DIS-2024-002 - Jane Smith (Business Loan)</option>
                            <option value="3">DIS-2024-003 - Robert Johnson (Emergency Loan)</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="repayment_amount" class="block text-sm font-medium text-gray-700">Amount (₱)</label>
                        <input type="number" id="repayment_amount" name="repayment_amount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="repayment_date" class="block text-sm font-medium text-gray-700">Payment Date</label>
                        <input type="date" id="repayment_date" name="repayment_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="repayment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                        <select id="repayment_method" name="repayment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="Check">Check</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="repayment_notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea id="repayment_notes" name="repayment_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeRepaymentModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
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

    <!-- View Disbursement Modal -->
    <div id="viewDisbursementModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900">Disbursement Details</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Disbursement ID</h4>
                        <p id="viewDisbursementId" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Member</h4>
                        <p id="viewDisbursementMember" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Loan Type</h4>
                        <p id="viewDisbursementLoanType" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Amount</h4>
                        <p id="viewDisbursementAmount" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Date Disbursed</h4>
                        <p id="viewDisbursementDate" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Disbursement Method</h4>
                        <p id="viewDisbursementMethod" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Status</h4>
                        <p id="viewDisbursementStatus" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Notes</h4>
                        <p id="viewDisbursementNotes" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button onclick="closeViewDisbursementModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Repayment Modal -->
    <div id="viewRepaymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900">Repayment Details</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Repayment ID</h4>
                        <p id="viewRepaymentId" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Member</h4>
                        <p id="viewRepaymentMember" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Loan Type</h4>
                        <p id="viewRepaymentLoanType" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Amount</h4>
                        <p id="viewRepaymentAmount" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Due Date</h4>
                        <p id="viewRepaymentDueDate" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Payment Date</h4>
                        <p id="viewRepaymentDate" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Payment Method</h4>
                        <p id="viewRepaymentMethod" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Status</h4>
                        <p id="viewRepaymentStatus" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Notes</h4>
                        <p id="viewRepaymentNotes" class="mt-1 text-sm text-gray-900"></p>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button onclick="closeViewRepaymentModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    // Tab Functions
    function switchTab(tab) {
        if (tab === 'disbursements') {
            document.getElementById('disbursementsTab').classList.add('border-blue-500', 'text-blue-600');
            document.getElementById('disbursementsTab').classList.remove('border-transparent', 'text-gray-500');
            document.getElementById('repaymentsTab').classList.add('border-transparent', 'text-gray-500');
            document.getElementById('repaymentsTab').classList.remove('border-blue-500', 'text-blue-600');
            document.getElementById('disbursementsTable').classList.remove('hidden');
            document.getElementById('repaymentsTable').classList.add('hidden');
            document.getElementById('addDisbursementBtn').classList.remove('hidden');
            document.getElementById('addRepaymentBtn').classList.add('hidden');
        } else {
            document.getElementById('repaymentsTab').classList.add('border-blue-500', 'text-blue-600');
            document.getElementById('repaymentsTab').classList.remove('border-transparent', 'text-gray-500');
            document.getElementById('disbursementsTab').classList.add('border-transparent', 'text-gray-500');
            document.getElementById('disbursementsTab').classList.remove('border-blue-500', 'text-blue-600');
            document.getElementById('repaymentsTable').classList.remove('hidden');
            document.getElementById('disbursementsTable').classList.add('hidden');
            document.getElementById('addRepaymentBtn').classList.remove('hidden');
            document.getElementById('addDisbursementBtn').classList.add('hidden');
        }
    }

    // Modal Functions
    function openAddDisbursementModal() {
        document.getElementById('disbursementModalTitle').textContent = 'New Disbursement';
        document.getElementById('disbursementForm').reset();
        document.getElementById('disbursementId').value = '';
        document.getElementById('disbursementModal').classList.remove('hidden');
    }

    function closeDisbursementModal() {
        document.getElementById('disbursementModal').classList.add('hidden');
    }

    function openAddRepaymentModal() {
        document.getElementById('repaymentModalTitle').textContent = 'New Repayment';
        document.getElementById('repaymentForm').reset();
        document.getElementById('repaymentId').value = '';
        document.getElementById('repaymentModal').classList.remove('hidden');
    }

    function closeRepaymentModal() {
        document.getElementById('repaymentModal').classList.add('hidden');
    }

    function closeViewDisbursementModal() {
        document.getElementById('viewDisbursementModal').classList.add('hidden');
    }

    function closeViewRepaymentModal() {
        document.getElementById('viewRepaymentModal').classList.add('hidden');
    }

    // Disbursement Functions
    function viewDisbursement(id) {
        const disbursement = disbursements.find(dis => dis.id === id);
        if (disbursement) {
            document.getElementById('viewDisbursementId').textContent = disbursement.disbursement_id;
            document.getElementById('viewDisbursementMember').textContent = disbursement.member;
            document.getElementById('viewDisbursementLoanType').textContent = disbursement.loan_type;
            document.getElementById('viewDisbursementAmount').textContent = disbursement.amount;
            document.getElementById('viewDisbursementDate').textContent = new Date(disbursement.date_disbursed).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            document.getElementById('viewDisbursementMethod').textContent = 'Bank Transfer'; // Dummy method
            document.getElementById('viewDisbursementStatus').textContent = disbursement.status;
            document.getElementById('viewDisbursementNotes').textContent = 'No additional notes'; // Dummy notes
            document.getElementById('viewDisbursementModal').classList.remove('hidden');
        }
    }

    function processDisbursement(id) {
        const disbursement = disbursements.find(dis => dis.id === id);
        if (disbursement) {
            document.getElementById('disbursementModalTitle').textContent = 'Process Disbursement';
            document.getElementById('disbursementId').value = id;
            document.getElementById('disbursement_loan').value = '1'; // Dummy value
            document.getElementById('disbursement_amount').value = parseFloat(disbursement.amount.replace('₱', '').replace(',', ''));
            document.getElementById('disbursement_date').value = disbursement.date_disbursed;
            document.getElementById('disbursement_method').value = 'Bank Transfer';
            document.getElementById('disbursement_notes').value = '';
            document.getElementById('disbursementModal').classList.remove('hidden');
        }
    }

    function printDisbursement(id) {
        console.log('Print disbursement:', id);
        // Implement print functionality
    }

    // Repayment Functions
    function viewRepayment(id) {
        const repayment = repayments.find(rep => rep.id === id);
        if (repayment) {
            document.getElementById('viewRepaymentId').textContent = repayment.repayment_id;
            document.getElementById('viewRepaymentMember').textContent = repayment.member;
            document.getElementById('viewRepaymentLoanType').textContent = repayment.loan_type;
            document.getElementById('viewRepaymentAmount').textContent = repayment.amount;
            document.getElementById('viewRepaymentDueDate').textContent = new Date(repayment.due_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            document.getElementById('viewRepaymentDate').textContent = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }); // Dummy date
            document.getElementById('viewRepaymentMethod').textContent = 'Bank Transfer'; // Dummy method
            document.getElementById('viewRepaymentStatus').textContent = repayment.status;
            document.getElementById('viewRepaymentNotes').textContent = 'No additional notes'; // Dummy notes
            document.getElementById('viewRepaymentModal').classList.remove('hidden');
        }
    }

    function processRepayment(id) {
        const repayment = repayments.find(rep => rep.id === id);
        if (repayment) {
            document.getElementById('repaymentModalTitle').textContent = 'Process Repayment';
            document.getElementById('repaymentId').value = id;
            document.getElementById('repayment_loan').value = '1'; // Dummy value
            document.getElementById('repayment_amount').value = parseFloat(repayment.amount.replace('₱', '').replace(',', ''));
            document.getElementById('repayment_date').value = new Date().toISOString().split('T')[0];
            document.getElementById('repayment_method').value = 'Bank Transfer';
            document.getElementById('repayment_notes').value = '';
            document.getElementById('repaymentModal').classList.remove('hidden');
        }
    }

    function printRepayment(id) {
        console.log('Print repayment:', id);
        // Implement print functionality
    }

    // Form Submissions
    document.getElementById('disbursementForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            loan: document.getElementById('disbursement_loan').value,
            amount: document.getElementById('disbursement_amount').value,
            date: document.getElementById('disbursement_date').value,
            method: document.getElementById('disbursement_method').value,
            notes: document.getElementById('disbursement_notes').value
        };
        console.log('Disbursement form submitted:', formData);
        closeDisbursementModal();
    });

    document.getElementById('repaymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            loan: document.getElementById('repayment_loan').value,
            amount: document.getElementById('repayment_amount').value,
            date: document.getElementById('repayment_date').value,
            method: document.getElementById('repayment_method').value,
            notes: document.getElementById('repayment_notes').value
        };
        console.log('Repayment form submitted:', formData);
        closeRepaymentModal();
    });

    // Store data for JavaScript functions
    const disbursements = @json($disbursements);
    const repayments = @json($repayments);
</script>
@endpush
@endsection


