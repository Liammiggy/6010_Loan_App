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
                    @if(auth()->user()->hasPermission('loan_status'))
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($disbursements as $disbursement)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $disbursement['disbursement_id'] }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $disbursement['member_name'] }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $disbursement["loan_type_name"] }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900"> 
                            @php
                                $amount = $disbursement['amount'] - $disbursement->loan_application->transaction_fee;
                                $amount = fmod($amount, 1) == 0
                                    ? number_format($amount, 0)
                                    : rtrim(rtrim(number_format($amount, 2, '.', ''), '0'), '.')
                            @endphp
                            ₱ {{ $amount }}
                        </div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ date('M d, Y', strtotime($disbursement['disbursement_date'])) }}</div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'approved' => 'bg-green-100 text-green-800',
                                'canceled' => 'bg-yellow-100 text-yellow-800'
                            ];
                        @endphp
                        <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$disbursement['status']] }}">
                            {{ $disbursement['status'] == 'approved' ? 'Completed' : 'Canceled' }}
                        </span>
                    </td>
                    @if(auth()->user()->hasPermission('loan_status'))
                    <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('disbursements.edit', ['id' => $disbursement['id']]) }}" class="text-blue-600 hover:text-blue-900 mr-2 text-sm"> Edit </a>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center" class="px-4 py-2 whitespace-nowrap"> No Disbursement to show </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $disbursements->links() }}
</div>