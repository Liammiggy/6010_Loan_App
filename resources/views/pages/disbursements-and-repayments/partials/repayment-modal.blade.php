<div id="repaymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900" id="repaymentModalTitle">New Repayment</h3>
            <form id="repaymentForm" class="mt-4">
                <input type="hidden" id="id">
                <div class="mb-4">
                    <label for="disbursement_id" class="block text-sm font-medium text-gray-700">Loan</label>
                    <input type="text" id="disbursement_id" name="disbursement_id" class="mt-1 block w-full border py-2 px-3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount (₱)</label>
                    <input type="number" id="amount" name="amount" class="mt-1 border py-2 px-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="repayment_date" class="block text-sm font-medium text-gray-700">Payment Date</label>
                    <input type="date" id="repayment_date" name="repayment_date" class="mt-1 border py-2 px-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="repayment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select id="repayment_method" name="repayment_method" class="mt-1 border py-2 px-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Check">Check</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="collector" class="block text-sm font-medium text-gray-700">Collector</label>
                    <input type="text" id="collector" name="collector" class="mt-1 border py-2 px-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea id="notes" name="notes" rows="3" class="mt-1 border py-2 px-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
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