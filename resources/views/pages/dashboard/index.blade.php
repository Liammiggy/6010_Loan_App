@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Dashboard'])

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Loans -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Loans</h3>
                    <p class="text-2xl font-semibold text-gray-900">₱2,450,000</p>
                    <p class="text-sm text-green-600">+12.5% from last month</p>
                </div>
            </div>
        </div>

        <!-- Active Loans -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Active Loans</h3>
                    <p class="text-2xl font-semibold text-gray-900">24</p>
                    <p class="text-sm text-green-600">+2 from last week</p>
                </div>
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Pending Applications</h3>
                    <p class="text-2xl font-semibold text-gray-900">8</p>
                    <p class="text-sm text-red-600">+3 new today</p>
                </div>
            </div>
        </div>

        <!-- Overdue Payments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Overdue Payments</h3>
                    <p class="text-2xl font-semibold text-gray-900">5</p>
                    <p class="text-sm text-red-600">Total: ₱45,000</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Loan Distribution Chart -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Loan Distribution by Type</h3>
            <div class="h-64">
                <canvas id="loanDistributionChart"></canvas>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activities</h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="p-2 rounded-full bg-blue-100 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-900">New loan application received from John Doe</p>
                        <p class="text-xs text-gray-500">Personal Loan - ₱50,000</p>
                        <p class="text-xs text-gray-400">2 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="p-2 rounded-full bg-green-100 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-900">Loan disbursed to Jane Smith</p>
                        <p class="text-xs text-gray-500">Business Loan - ₱200,000</p>
                        <p class="text-xs text-gray-400">1 hour ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="p-2 rounded-full bg-yellow-100 text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-900">Payment reminder sent to Robert Johnson</p>
                        <p class="text-xs text-gray-500">Due in 2 days - ₱4,500</p>
                        <p class="text-xs text-gray-400">3 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="p-2 rounded-full bg-red-100 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-900">Overdue payment from Maria Garcia</p>
                        <p class="text-xs text-gray-500">Emergency Loan - ₱3,000</p>
                        <p class="text-xs text-gray-400">5 hours ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Payments and Loan Applications -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <!-- Upcoming Payments -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Upcoming Payments</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">₱4,500</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Apr 15, 2024</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Jane Smith</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">₱8,500</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Apr 16, 2024</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Robert Johnson</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">₱3,500</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Apr 17, 2024</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Loan Applications -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Loan Applications</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Personal Loan</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">₱50,000</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Jane Smith</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Business Loan</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">₱200,000</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Robert Johnson</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Emergency Loan</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">₱20,000</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Loan Distribution Chart
    const ctx = document.getElementById('loanDistributionChart').getContext('2d');
    const loanDistributionChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Personal Loans', 'Business Loans', 'Emergency Loans', 'Education Loans', 'Housing Loans'],
            datasets: [{
                data: [30, 25, 15, 20, 10],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(245, 158, 11, 1)',
                    'rgba(139, 92, 246, 1)',
                    'rgba(239, 68, 68, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });
</script>
@endpush
@endsection


