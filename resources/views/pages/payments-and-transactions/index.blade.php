@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Payments and Transactions'])

    <!-- Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <div class="flex justify-between items-center">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button onclick="switchTab('payments')" class="tab-button border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600" id="payments-tab">
                        Payments
                    </button>
                    <button onclick="switchTab('transactions')" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" id="transactions-tab">
                        Transactions
                    </button>
                </nav>
                <!-- Add Payment Button -->
                <button id="addPaymentBtn" onclick="openPaymentModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Payment
                </button>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div id="payments-panel" class="tab-panel">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loan</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Date</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $payments = [
                                ['member' => 'John Doe', 'loan' => 'L-2024-001', 'amount' => '₱5,000.00', 'date' => '2024-03-15', 'status' => 'Completed'],
                                ['member' => 'Jane Smith', 'loan' => 'L-2024-002', 'amount' => '₱3,500.00', 'date' => '2024-03-14', 'status' => 'Completed'],
                                ['member' => 'Michael Johnson', 'loan' => 'L-2024-003', 'amount' => '₱7,200.00', 'date' => '2024-03-13', 'status' => 'Pending'],
                                ['member' => 'Sarah Williams', 'loan' => 'L-2024-004', 'amount' => '₱4,800.00', 'date' => '2024-03-12', 'status' => 'Completed'],
                                ['member' => 'Robert Brown', 'loan' => 'L-2024-005', 'amount' => '₱6,000.00', 'date' => '2024-03-11', 'status' => 'Failed'],
                                ['member' => 'Emily Davis', 'loan' => 'L-2024-006', 'amount' => '₱2,500.00', 'date' => '2024-03-10', 'status' => 'Completed'],
                                ['member' => 'David Wilson', 'loan' => 'L-2024-007', 'amount' => '₱8,000.00', 'date' => '2024-03-09', 'status' => 'Completed'],
                                ['member' => 'Jennifer Taylor', 'loan' => 'L-2024-008', 'amount' => '₱3,000.00', 'date' => '2024-03-08', 'status' => 'Pending'],
                                ['member' => 'Thomas Anderson', 'loan' => 'L-2024-009', 'amount' => '₱5,500.00', 'date' => '2024-03-07', 'status' => 'Completed'],
                                ['member' => 'Lisa Martinez', 'loan' => 'L-2024-010', 'amount' => '₱4,200.00', 'date' => '2024-03-06', 'status' => 'Completed']
                            ];
                        @endphp
                        @foreach($payments as $index => $payment)
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-7 w-7">
                                        <img class="h-7 w-7 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($payment['member']) }}" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $payment['member'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $payment['loan'] }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $payment['amount'] }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $payment['date'] }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $payment['status'] === 'Completed' ? 'bg-green-100 text-green-800' : 
                                       ($payment['status'] === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                       'bg-red-100 text-red-800') }}">
                                    {{ $payment['status'] }}
                                </span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="viewPayment({{ $index + 1 }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</button>
                                <button onclick="printReceipt({{ $index + 1 }})" class="text-gray-600 hover:text-gray-900 text-sm">Print</button>
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

    <!-- Transactions Table -->
    <div id="transactions-panel" class="tab-panel hidden">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $transactions = [
                                ['id' => 'TXN-2024-001', 'type' => 'Loan Disbursement', 'member' => 'John Doe', 'amount' => '₱50,000.00', 'date' => '2024-03-15'],
                                ['id' => 'TXN-2024-002', 'type' => 'Payment', 'member' => 'Jane Smith', 'amount' => '₱3,500.00', 'date' => '2024-03-14'],
                                ['id' => 'TXN-2024-003', 'type' => 'Loan Disbursement', 'member' => 'Michael Johnson', 'amount' => '₱25,000.00', 'date' => '2024-03-13'],
                                ['id' => 'TXN-2024-004', 'type' => 'Payment', 'member' => 'Sarah Williams', 'amount' => '₱4,800.00', 'date' => '2024-03-12'],
                                ['id' => 'TXN-2024-005', 'type' => 'Loan Disbursement', 'member' => 'Robert Brown', 'amount' => '₱30,000.00', 'date' => '2024-03-11'],
                                ['id' => 'TXN-2024-006', 'type' => 'Payment', 'member' => 'Emily Davis', 'amount' => '₱2,500.00', 'date' => '2024-03-10'],
                                ['id' => 'TXN-2024-007', 'type' => 'Loan Disbursement', 'member' => 'David Wilson', 'amount' => '₱40,000.00', 'date' => '2024-03-09'],
                                ['id' => 'TXN-2024-008', 'type' => 'Payment', 'member' => 'Jennifer Taylor', 'amount' => '₱3,000.00', 'date' => '2024-03-08'],
                                ['id' => 'TXN-2024-009', 'type' => 'Loan Disbursement', 'member' => 'Thomas Anderson', 'amount' => '₱35,000.00', 'date' => '2024-03-07'],
                                ['id' => 'TXN-2024-010', 'type' => 'Payment', 'member' => 'Lisa Martinez', 'amount' => '₱4,200.00', 'date' => '2024-03-06']
                            ];
                        @endphp
                        @foreach($transactions as $index => $transaction)
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $transaction['id'] }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $transaction['type'] === 'Payment' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $transaction['type'] }}
                                </span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-7 w-7">
                                        <img class="h-7 w-7 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($transaction['member']) }}" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $transaction['member'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $transaction['amount'] }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $transaction['date'] }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="viewTransaction({{ $index + 1 }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</button>
                                <button onclick="printTransaction({{ $index + 1 }})" class="text-gray-600 hover:text-gray-900 text-sm">Print</button>
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
    }

    function openPaymentModal() {
        // Implement payment modal opening logic
        console.log('Open payment modal');
    }

    function viewPayment(paymentId) {
        // Implement view payment logic
        console.log('View payment:', paymentId);
    }

    function printReceipt(paymentId) {
        // Implement print receipt logic
        console.log('Print receipt for payment:', paymentId);
    }

    function viewTransaction(transactionId) {
        // Implement view transaction logic
        console.log('View transaction:', transactionId);
    }

    function printTransaction(transactionId) {
        // Implement print transaction logic
        console.log('Print transaction:', transactionId);
    }
</script>
@endpush
@endsection


