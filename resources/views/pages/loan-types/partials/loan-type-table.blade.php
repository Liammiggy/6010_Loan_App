<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interest Rate</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($loanTypes as $loanType)
            <tr>
                <td class="px-4 py-2 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $loanType['name'] }}</div>
                </td>
                <td class="px-4 py-2">
                    <div class="text-sm text-gray-900">{{ $loanType['description'] }}</div>
                </td>
                <td class="px-4 py-2 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        {{ fmod($loanType['interest_rate'], 1) == 0 ? number_format($loanType['interest_rate'], 0) : rtrim(rtrim(number_format($loanType['interest_rate'], 2, '.', ''), '0'), '.') }}%
                    </div>
                    
                </td>
                <td class="px-4 py-2 whitespace-nowrap">
                    <span class="px-1.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $loanType['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $loanType['is_active'] ? 'Active' : 'Inactive' }}
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

{{ $loanTypes->links() }}