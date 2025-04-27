<div id="disbursementModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900" id="disbursementModalTitle">New Disbursement</h3>
            <form id="disbursementForm" class="mt-4">
                <input type="hidden" id="disbursementId">
                <div class="mb-4">
                    <label for="disbursement_loan" class="block text-sm font-medium text-gray-700">Loan Application</label>
                    <select id="disbursement_loan" name="disbursement_loan" class="mt-1 block w-full 
                    rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">-- Select Loan Application -- </option>
                        @forelse($loanApplications as $loanApplication)
                            <option value="{{$loanApplication->id}}"> 
                                {{ $loanApplication->application_id }} - {{ $loanApplication->member_name }} {{ $loanApplication->loan_type_detail }}
                            </option>
                        @empty
                        @endforelse
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