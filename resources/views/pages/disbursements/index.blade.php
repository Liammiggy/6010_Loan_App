@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => $type . ' Disbursements', 'current_route' => route('disbursements-and-repayments')])

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 gap-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <form id="disbursement-form">
                        <div class="mb-2">
                            <label for="disbursement_loan" class="block text-sm font-medium text-gray-700">Loan
                                Application</label>
                            <select id="disbursement_loan" name="disbursement_loan" {{ $type == 'New' ? '' : 'disabled' }}
                                class="mt-1 block w-full border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-100
                                    rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                               
                                @forelse($loanApplications as $index => $loanApplication)
                                    @if($index == 0)
                                        <option value="">-- Select Loan Application -- </option>
                                    @endif
                                    <option value="{{$loanApplication->id}}">
                                        {{ $loanApplication->application_id }} - {{ $loanApplication->member_name }}
                                        {{ $loanApplication->loan_type_detail }}
                                    </option>
                                @empty
                                    <option value="">-- No Loan Application -- </option>
                                @endforelse
                                
                            </select>
                        </div>
                        <div id="loanSummary" class="bg-gray-50 p-6 rounded-lg relative mb-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Loan Summary</h3>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600">Fill in the details and click "Generate Loan Schedule" to see the
                                    summary.</p>
                            </div>
                        </div>
                        <textarea id="loan_summary" name="loan_summary" rows="4"
                            class="hidden mt-1 block w-full border py-2 px-3 mb-2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                        <button type="button"
                            id="disburse-loan"
                            disabled
                            class="w-full bg-indigo-600 disabled:bg-indigo-300 text-white px-4 py-2 rounded-md mb-2
                            hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                            disabled:cursor-not-allowed">
                            Approve Disbursement
                        </button>
                        <button type="button"
                            id="cancel-disbursement"
                            disabled
                            class="w-full bg-gray-600 disabled:bg-gray-300 text-white px-4 py-2 rounded-md mb-2
                            hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                            disabled:cursor-not-allowed">
                            Cancel Disbursement
                        </button>
                    </form>
                    <!-- Payment Schedule Table -->
                    <div id="scheduleTable" class="mt-6">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Schedule</h3>
                            <p class="text-sm text-gray-600">The payment schedule will appear here after generating the loan
                                details.</p>
                        </div>
                    </div>
                </div>
                
                
            </div>

            
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const loanApplications = @json($loanApplications ?? []);
        const disbursement_loan = document.getElementById('disbursement_loan');
        const form_type = "{{ $type }}";
        const disbursement_id = "{{ $id ?? NULL}}";
        const disbursement = @json($disbursement ?? null);

        function formatCurrency(amount) {
            const number = Number(amount)
            return "₱ " + (Number.isInteger(number) ? number : number.toFixed(2));
        }

        function generateSchedule(startDate, term, frequency) {
            function addDays(date, days) {
                const result = new Date(date);
                result.setDate(result.getDate() + days);
                return result;
            }

            function addWeeks(date, weeks) {
                return addDays(date, weeks * 7);
            }

            function addMonths(date, months) {
                const result = new Date(date);
                result.setMonth(result.getMonth() + months);
                return result;
            }
            
            let dates = [];
            let current = new Date(startDate);

            for (let i = 0; i < term; i++) {
                dates.push(new Date(current));
                switch (frequency) {
                    case 'daily':
                        current = addDays(current, 1);
                        break;
                    case 'weekly':
                        current = addWeeks(current, 1);
                        break;
                    case 'semi-monthly':
                        current = addDays(current, 15);
                        break;
                    case 'monthly':
                        current = addMonths(current, 1);
                        break;
                }
            }
            return dates;
        }

        disbursement_loan.addEventListener('change', function () {
            const selectedLoan = loanApplications.find(loan => loan.id == this.value)
            if (this.value !== "") {
                
                const releaseDate = disbursement ? new Date(disbursement.disbursement_date) : new Date();
                const scheduleDates = generateSchedule(releaseDate, selectedLoan.term, selectedLoan.frequency);
                const maturityDate = scheduleDates[scheduleDates.length - 1];

                const interest = selectedLoan.amount * (selectedLoan.interest_rate / 100);
                const totalDue = parseFloat(selectedLoan.amount) + interest;
                const amortization = totalDue / selectedLoan.term;

                let template_disbursement = ``
                if(form_type == 'Edit') {
                    template_disbursement += `<div class="flex justify-between">
                        <span class="text-sm text-gray-600">Disbursement ID:</span>
                        <span class="text-sm font-medium text-gray-900">${disbursement.disbursement_id}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="text-sm font-medium text-gray-900">${disbursement.status.charAt(0).toUpperCase() + disbursement.status.slice(1)}</span>
                    </div>
                    <hr class="border-t border-gray-300 my-4"></hr>
                    `
                }

                document.getElementById('loanSummary').innerHTML = `
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Loan Summary</h3>
                    <div class="space-y-2">
                        ${template_disbursement}
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Loan Type:</span>
                            <span class="text-sm font-medium text-gray-900">${selectedLoan.loan_type.name}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Release Date:</span>
                            <span class="text-sm font-medium text-gray-900">${releaseDate.toDateString()}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Maturity Date:</span>
                            <span class="text-sm font-medium text-gray-900">${maturityDate.toDateString()}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Loan Amount:</span>
                            <span class="text-sm font-medium text-gray-900">${formatCurrency(selectedLoan.amount)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Interest (${selectedLoan.interest_rate}%):</span>
                            <span class="text-sm font-medium text-gray-900">${formatCurrency(interest)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Total Due:</span>
                            <span class="text-sm font-medium text-gray-900">${formatCurrency(totalDue)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Term (${selectedLoan.frequency}):</span>
                            <span class="text-sm font-medium text-gray-900">${selectedLoan.term}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Amortization per Payment:</span>
                            <span class="text-sm font-medium text-gray-900">${formatCurrency(amortization)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Transaction Fee:</span>
                            <span class="text-sm font-medium text-gray-900">${formatCurrency(selectedLoan.transaction_fee)}</span>
                        </div>
                        <hr class="border-t border-gray-300 my-4"></hr>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Disbursement Amount:</span>
                            <span class="text-sm font-medium text-gray-900">${formatCurrency(selectedLoan.amount - selectedLoan.transaction_fee)}</span>
                        </div>
                    </div>
                `

                let scheduleHTML = `
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Schedule (${selectedLoan.frequency.charAt(0).toUpperCase() + selectedLoan.frequency.slice(1)})</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                `;

                scheduleDates.forEach((date, index) => {
                    scheduleHTML += `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${date.toDateString()}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatCurrency(amortization)}</td>
                        </tr>
                    `;
                });

                scheduleHTML += `
                            </tbody>
                        </table>
                    </div>
                `;
                document.getElementById('scheduleTable').innerHTML = scheduleHTML;

                if(form_type == 'New'){ 
                    document.getElementById('loan_summary').classList.remove('hidden');
                    document.getElementById('disburse-loan').disabled = false;
                    document.getElementById('cancel-disbursement').disabled = false;
                } else {
                    disbursement.status == 'approved' ? document.getElementById('disburse-loan').disabled = true : document.getElementById('disburse-loan').disabled = false;
                    disbursement.status == 'canceled' ? document.getElementById('cancel-disbursement').disabled = true : document.getElementById('cancel-disbursement').disabled = false;
                }
                
            } else {
                if(form_type == 'New') document.getElementById('loan_summary').classList.add('hidden');
                document.getElementById('disburse-loan').disabled = true;
                document.getElementById('cancel-disbursement').disabled = true;
            }
        })
        
        if(disbursement_id !== undefined || disbursement_id !== "") {
            disbursement_loan.value = disbursement_id
            const event = new Event('change', { bubbles: true });
            disbursement_loan.dispatchEvent(event);
        }

        function submitForm(type) {
            const formData = {
                loan_application_id: disbursement_loan.value,
                notes: document.getElementById('loan_summary').value,
                status: type == 'approve' ? 'approved' : 'canceled',
            }

            fetch(form_type == 'New' ? '/disbursements' : `/disbursements/${disbursement_id}`, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    throw new Error('Failed to save disbursement');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to save disbursement. Please try again.');
            });
        }
        document.getElementById('disburse-loan').addEventListener('click', () => submitForm('approve'))
        document.getElementById('cancel-disbursement').addEventListener('click', () => submitForm('cancel'))
    </script>
@endpush