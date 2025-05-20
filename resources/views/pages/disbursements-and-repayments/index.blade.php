@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Disbursements and Repayments'])

    <!-- Tabs Navigation -->
    <div class="mb-6 flex justify-between items-center">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button onclick="switchTab('disbursements')" id="disbursementsTab"
                    class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Disbursements
                </button>
                <button onclick="switchTab('repayments')" id="repaymentsTab"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Repayments
                </button>
            </nav>
        </div>
        <div>
            <a href="{{ route('disbursements.index') }}" id="addDisbursementBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                New Disbursement
            </a>
        </div>
    </div>

    <!-- Disbursements Table -->
    @include('pages.disbursements-and-repayments.partials.disbursement-table')

    <!-- Repayments Table -->
    @include('pages.disbursements-and-repayments.partials.repayments-table')

    <!-- Add/Edit Disbursement Modal -->
    @include('pages.disbursements-and-repayments.partials.disbursement-modal')

    <!-- Add/Edit Repayment Modal -->
    @include('pages.disbursements-and-repayments.partials.repayment-modal')

    <!-- View Disbursement Modal -->
    @include('pages.disbursements-and-repayments.partials.view-disbursement-modal')

    <!-- View Repayment Modal -->
    @include('pages.disbursements-and-repayments.partials.view-repayment-modal')

    @push('scripts')
        <script>
            // Store data for JavaScript functions
            const disbursements = @json(empty($disbursements) ? null : $disbursements);
            const repayments = @json(empty($repayments) ? null : $repayments);
            const loanApplications = @json(empty($loanApplications) ? null : $loanApplications);
            const disbursement_loan = document.getElementById("disbursement_loan")
            function LoanApplicationDisbursementChange(event) {
                const disbursement_amount = document.getElementById("disbursement_amount")
                const target = event.target
                if (target.value) {
                    loanApplications.forEach(application => { if (target.value == application.id) disbursement_amount.value = application.amount })
                } else {
                    disbursement_amount.value = ''
                }
            }
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
                    // document.getElementById('addRepaymentBtn').classList.add('hidden');
                } else {
                    document.getElementById('repaymentsTab').classList.add('border-blue-500', 'text-blue-600');
                    document.getElementById('repaymentsTab').classList.remove('border-transparent', 'text-gray-500');
                    document.getElementById('disbursementsTab').classList.add('border-transparent', 'text-gray-500');
                    document.getElementById('disbursementsTab').classList.remove('border-blue-500', 'text-blue-600');
                    document.getElementById('repaymentsTable').classList.remove('hidden');
                    document.getElementById('disbursementsTable').classList.add('hidden');
                    // document.getElementById('addRepaymentBtn').classList.remove('hidden');
                    document.getElementById('addDisbursementBtn').classList.add('hidden');
                }
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
                const repayment = repayments.data.find(rep => rep.id === id);
                if (repayment) {
                    document.getElementById('viewRepaymentId').textContent = repayment.repayment_id;
                    document.getElementById('viewRepaymentMember').textContent = repayment.member;
                    document.getElementById('viewRepaymentLoanType').textContent = repayment.loan_type;
                    document.getElementById('viewRepaymentAmount').textContent = repayment.amount;
                    document.getElementById('viewRepaymentDueDate').textContent = new Date(repayment.due_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                    document.getElementById('viewRepaymentDate').textContent = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }); // Dummy date
                    document.getElementById('viewRepaymentMethod').textContent = 'Bank Transfer';
                    document.getElementById('viewRepaymentStatus').textContent = repayment.status.charAt(0).toUpperCase() + repayment.status.slice(1);
                    document.getElementById('viewRepaymentNotes').textContent = 'No additional notes'; 
                    document.getElementById('viewRepaymentModal').classList.remove('hidden');
                }
            }

            function processRepayment(id) {
                const repayment = repayments.data.find(rep => rep.id === id);
                if (repayment) {
                    document.getElementById('repaymentModalTitle').textContent = 'Process Repayment';
                    document.getElementById('id').value = id;
                    document.getElementById('disbursement_id').value = repayment.disbursement.disbursement_id; 
                    document.getElementById('amount').value = parseFloat(repayment.amount.replace('₱', '').replace(',', ''));
                    document.getElementById('repayment_date').value = new Date().toISOString().split('T')[0];
                    document.getElementById('repayment_method').value = 'Cash';
                    document.getElementById('notes').value = '';
                    document.getElementById('repaymentModal').classList.remove('hidden');
                }
            }

            function printRepayment(id) {
                console.log('Print repayment:', id);
                // Implement print functionality
            }

            document.getElementById('repaymentForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = {
                    amount: document.getElementById('amount').value,
                    repayment_date: document.getElementById('repayment_date').value,
                    repayment_method: document.getElementById('repayment_method').value,
                    collector: document.getElementById('collector').value,
                    notes: document.getElementById('notes').value
                };
                fetch(`/repayments/${document.getElementById('id').value}`, {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to save disbursement');
                    } else {
                        closeRepaymentModal();
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to save disbursement. Please try again.');
                });
                
            });

        </script>
    @endpush
@endsection