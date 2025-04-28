@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => $type . ' Loan Applications', 'current_route' => route('loan-applications')])

    <form method="POST" action="{{ route('loan-applcations.store') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @csrf
        <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Input Form -->
                <div class="space-y-6">
                    <div>
                        <label for="loanAmount" class="block text-sm font-medium text-gray-700">Loan Amount (₱)</label>
                        <input type="number" id="loanAmount"
                            name="amount" 
                            @if(!empty($loanApplication)) 
                                value="{{ $loanApplication['amount'] }}" 
                                disabled
                            @else
                                value="3000"
                            @endif
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 py-2 px-3 focus:ring-indigo-500
                            disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed">
                    </div>

                    <div>
                        <label for="loan-type" class="block text-sm font-medium text-gray-700">Loan Type (%)</label>

                        <select
                            id="loan-type"
                            name="loan_type_id"
                            @if(!empty($loanApplication)) 
                                disabled
                            @endif
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 
                            focus:outline-none focus:ring-indigo-500 sm:text-sm disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed"
                        >
                            @forelse($loanTypes as $index => $loanType)
                                @if($index == 0)  <option value=""> -- Select Loan Type -- </option> @endif
                                <option value="{{ $loanType['id'] }}" @selected(!empty($loanApplication) && $loanApplication['loan_type_id'] == $loanType['id'])>
                                    {{ $loanType['name'] }}
                                    (default:
                                    {{ fmod($loanType['interest_rate'], 1) == 0
                                        ? number_format($loanType['interest_rate'], 0)
                                        : rtrim(rtrim(number_format($loanType['interest_rate'], 2, '.', ''), '0'), '.') }}%)
                                </option>
                            @empty
                                <option value="">No Loan Types Available</option>
                            @endforelse
                        </select>
                    </div>

                    <div>
                        <label for="interest" class="block text-sm font-medium text-gray-700">Interest Rate (%)</label>
                        <input
                            type="number"
                            id="interest"
                            name="interest_rate"
                            @if(!empty($loanApplication['interest_rate'])) 
                                value="{{ fmod($loanType['interest_rate'], 1) == 0
                                        ? number_format($loanType['interest_rate'], 0)
                                        : rtrim(rtrim(number_format($loanType['interest_rate'], 2, '.', ''), '0'), '.') }}"
                            @else 
                                value="20"
                            @endif
                            disabled
                            class="mt-1 block w-full rounded-md border border-gray-300 
                                shadow-sm py-2 px-3 disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed"
                        >
                    </div>

                    <div>
                        <label for="term" class="block text-sm font-medium text-gray-700">Payment Term</label>
                        <input type="number" id="term" value="60" name="term"
                            @if(!empty($loanApplication['term'])) 
                                value="{{ $loanApplication['term'] }}"
                                disabled
                            @else 
                                value="60"
                            @endif
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 py-2 px-3 focus:ring-indigo-500
                            disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed">
                    </div>

                    <div>
                        <label for="frequency" class="block text-sm font-medium text-gray-700">Payment Frequency</label>
                        <select id="frequency" name="frequency"
                            @if(!empty($loanApplication['term'])) 
                                disabled
                            @endif
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 py-2 px-3 focus:ring-indigo-500
                            disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed">
                            <option value="daily" @selected(!empty($loanApplication) && $loanApplication['frequency'] == 'daily')>Daily</option>
                            <option value="weekly" @selected(!empty($loanApplication) && $loanApplication['frequency'] == 'weekly')>Weekly</option>
                            <option value="semi-monthly" @selected(!empty($loanApplication) && $loanApplication['frequency'] == 'semi-monthly')>Semi-Monthly</option>
                            <option value="monthly" @selected(!empty($loanApplication) && $loanApplication['frequency'] == 'monthly')>Monthly</option>
                        </select>
                    </div>

                    <div>
                        <label for="frequency" class="block text-sm font-medium text-gray-700">Transaction Fee</label>
                        <input
                            type="number"
                            id="transaction_fee"
                            name="transaction_fee"
                            @if(!empty($loanApplication['transaction_fee'])) 
                                value="{{ fmod($loanApplication['transaction_fee'], 1) == 0
                                        ? number_format($loanApplication['transaction_fee'], 0)
                                        : rtrim(rtrim(number_format($loanApplication['transaction_fee'], 2, '.', ''), '0'), '.') }}"
                                disabled
                            @else 
                                value="0"
                            @endif
                            
                            class="mt-1 block w-full rounded-md border border-gray-300 
                                shadow-sm py-2 px-3 disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed"
                        >
                    </div>

                    @if(empty($loanApplication['interest_rate'])) 
                        <button onclick="generateLoan()" disabled type="button"
                            id="generate-loan"
                            class="w-full bg-indigo-600 disabled:bg-indigo-300 text-white px-4 py-2 rounded-md 
                            hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                            disabled:cursor-not-allowed">
                            Generate Loan Schedule
                        </button>
                    @endif
                </div>

                <!-- Loan Summary -->
                <div id="loanSummary" class="bg-gray-50 p-6 rounded-lg relative">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Loan Summary</h3>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600">Fill in the details and click "Generate Loan Schedule" to see the summary.</p>
                    </div>
                </div>
            </div>

            <!-- Payment Schedule Table -->
            <div id="scheduleTable" class="mt-8">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Schedule</h3>
                    <p class="text-sm text-gray-600">The payment schedule will appear here after generating the loan details.</p>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function formatCurrency(amount) {
            return "₱ " + parseFloat(amount).toFixed(2);
        }

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

        function generateSchedule(startDate, term, frequency) {
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

        function generateLoan() {
            const loanAmount = parseFloat(document.getElementById('loanAmount').value);
            const interestRate = parseFloat(document.getElementById('interest').value);
            const term = parseInt(document.getElementById('term').value);
            const frequency = document.getElementById('frequency').value;
            const transaction_fee = document.getElementById('transaction_fee').value;

            const interest = loanAmount * (interestRate / 100);
            const totalDue = loanAmount + interest;
            const amortization = totalDue / term;

            const releaseDate = new Date();
            const scheduleDates = generateSchedule(releaseDate, term, frequency);
            const maturityDate = scheduleDates[scheduleDates.length - 1];

            const members = @json($members);
            const loanApplication = @if(!empty($loanApplication)) @json($loanApplication) @else null @endif;
            
            let templateMembers = `<select name="member"
            id="new-member-select" onchange="newMemberSelect()"
            ${!(loanApplication == null) && "disabled"}
            class="mb-2 mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 
            disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed focus:outline-none focus:ring-indigo-500 sm:text-sm">`
            templateMembers += '<option value="new"> -- New Member -- </option>'
            members.forEach(member => {
                templateMembers += `<option value="${member.id}" ${!(loanApplication == null) && loanApplication.member_id == member.id && "selected"}> ${member.name} </option>`
                
            })
            templateMembers += "</select>"
            let templateForm = ``
            if(loanApplication == null) {
                templateForm += `<div class="mb-2 member-new">
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="name" name="name" class="border py-2 px-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>
                    <div class="mb-2 member-new">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="border py-2 px-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>
                    <div class="mb-2 member-new">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="border py-2 px-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>
                    <div class="mb-2 member-new">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="address" name="address" rows="3" class="border py-2 px-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required></textarea>
                    </div>
                    <button
                        id="generate-loan"
                        class="w-full bg-indigo-600 disabled:bg-indigo-300 text-white px-4 py-2 rounded-md 
                        hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                        disabled:cursor-not-allowed">
                        Submit Application
                    </button>`
            }
            document.getElementById('loanSummary').innerHTML = `
                <h3 class="text-lg font-medium text-gray-900 mb-4">Loan Summary</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Loan Amount:</span>
                        <span class="text-sm font-medium text-gray-900">${formatCurrency(loanAmount)}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Interest (${interestRate}%):</span>
                        <span class="text-sm font-medium text-gray-900">${formatCurrency(interest)}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Total Due:</span>
                        <span class="text-sm font-medium text-gray-900">${formatCurrency(totalDue)}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Term (${frequency}):</span>
                        <span class="text-sm font-medium text-gray-900">${term}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Amortization per Payment:</span>
                        <span class="text-sm font-medium text-gray-900">${formatCurrency(amortization)}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Transaction Fee:</span>
                        <span class="text-sm font-medium text-gray-900">${formatCurrency(transaction_fee)}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Disbursement Amount:</span>
                        <span class="text-sm font-medium text-gray-900">${formatCurrency(loanAmount - transaction_fee)}</span>
                    </div>
                </div>

                <div class="py-2">
                    ${templateMembers}
                    ${templateForm}
                </div>
            `;

            // Payment Schedule Table
            let scheduleHTML = `
                <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Schedule (${frequency.charAt(0).toUpperCase() + frequency.slice(1)})</h3>
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
            
        }

        if("{{$type}}" == 'View') {
            generateLoan()
        }
        
        function newMemberSelect(event) {
            const newMemberSelect = document.getElementById("new-member-select")
            const newMemberDiv = document.querySelectorAll(".member-new")
            if(newMemberSelect.value == "new") {
                newMemberDiv.forEach(div => {
                    div.style.display = 'block'
                    const inputs = div.querySelectorAll('input, textarea');
                    inputs.forEach(input => {
                        input.setAttribute('required', true);
                    });
                })
            } else {
                newMemberDiv.forEach(div => {
                    div.style.display = 'none'
                    const inputs = div.querySelectorAll('input, textarea');
                    inputs.forEach(input => {
                        input.removeAttribute('required');
                    });
                })
            }
        }

        const loanTypes = @json($loanTypes);

        if(loanTypes.length > 0) {
            document.getElementById('loan-type').addEventListener('change', function(event) {
                const target = event.target
                const interest = document.getElementById('interest')
                const generateLoan = document.getElementById('generate-loan')
                if(!target.value) {
                    interest.setAttribute('disabled', true)
                    generateLoan.setAttribute('disabled', true)
                } else {
                    interest.removeAttribute('disabled')
                    generateLoan.removeAttribute('disabled')
                }
            })
        }

    </script>
@endpush


