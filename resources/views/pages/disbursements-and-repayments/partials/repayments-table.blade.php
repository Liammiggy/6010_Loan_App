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
                @foreach($repayments as $repayment)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $repayment['repayment_id'] }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $repayment['member_name'] }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $repayment['loan_type'] }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">₱ {{ $repayment['amount'] }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ date('M d, Y', strtotime($repayment['repayment_date'])) }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'paid' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'overdue' => 'bg-red-100 text-red-800'
                            ];
                        @endphp
                        <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$repayment['status']] }}">
                            {{ ucwords($repayment['status']) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                        <button onclick="viewRepayment({{ $repayment['id'] }})" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</button>
                        <button onclick="processRepayment({{ $repayment['id'] }})" @if($repayment['status'] == 'paid') disabled @endif 
                            class="text-indigo-600 disabled:text-indigo-200 hover:text-indigo-900 mr-2 text-sm">Process</button>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    {{
        $repayments->links()
    }}
</div>