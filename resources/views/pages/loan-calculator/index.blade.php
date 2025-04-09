@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Loan Calculator'])

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Input Form -->
                <div class="space-y-6">

                    <div>
                        <label for="loanAmount" class="block text-sm font-medium text-gray-700">Loan Amount (₱)</label>
                        <input type="number" id="loanAmount" value="3000"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="interest" class="block text-sm font-medium text-gray-700">Interest Rate (%)</label>
                        <input type="number" id="interest" value="20"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="term" class="block text-sm font-medium text-gray-700">Payment Term</label>
                        <input type="number" id="term" value="60"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="frequency" class="block text-sm font-medium text-gray-700">Payment Frequency</label>
                        <select id="frequency"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="daily" selected>Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="semi-monthly">Semi-Monthly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>

                    <button onclick="generateLoan()"
                        class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Generate Loan Schedule
                    </button>
                </div>

                <!-- Loan Summary -->
                <div id="loanSummary" class="bg-gray-50 p-6 rounded-lg">
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
    </div>
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

            const interest = loanAmount * (interestRate / 100);
            const totalDue = loanAmount + interest;
            const amortization = totalDue / term;

            const releaseDate = new Date();
            const scheduleDates = generateSchedule(releaseDate, term, frequency);
            const maturityDate = scheduleDates[scheduleDates.length - 1];

            // Loan Summary
            document.getElementById('loanSummary').innerHTML = `
                <h3 class="text-lg font-medium text-gray-900 mb-4">Loan Summary</h3>
                <div class="space-y-2">
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
    </script>
@endpush