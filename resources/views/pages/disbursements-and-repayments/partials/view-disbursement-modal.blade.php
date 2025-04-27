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