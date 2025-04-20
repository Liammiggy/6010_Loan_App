@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Loan Applications'])

    <!-- Add Loan Application Button -->
    <div class="mb-6">
        <button onclick="openAddLoanApplicationModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            New Loan Application
        </button>
    </div>

    @include('pages.loan-applications.partials.loan-app-table')
    @include('pages.loan-applications.partials.loan-app-process-modal')

@push('scripts')
<script>
    function openAddLoanApplicationModal() {
        window.location.href = "{{ route('loan-applications.new') }}"
    }

    function closeProcessApplicationModal() {
        document.getElementById('processApplicationModal').classList.add('hidden');
    }

    function processApplication(id) {
        const application = loanApplications.find(app => app.id === id);
        if (application) {
            document.getElementById('processApplicationId').value = id;
            document.getElementById('status').value = application.status;
            document.getElementById('remarks').value = '';
            document.getElementById('processApplicationModal').classList.remove('hidden');
        }
    }

    function deleteApplication(id) {
        if (confirm('Are you sure you want to delete this loan application?')) {
            console.log('Delete application:', id);
            // Implement delete functionality
        }
    }

    document.getElementById('processApplicationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            id: document.getElementById('processApplicationId').value,
            status: document.getElementById('status').value,
            remarks: document.getElementById('remarks').value
        };
        const url = `/loan-applications/${document.getElementById('processApplicationId').value}`;
        const method = 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (response.ok) {
                closeProcessApplicationModal();
                window.location.reload();
            } else {
                throw new Error('Failed to update process');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update process. Please try again.');
        });
    });

    // Store applications data for JavaScript functions
    const loanApplications = @json($loanApplications).data;
</script>
@endpush
@endsection


