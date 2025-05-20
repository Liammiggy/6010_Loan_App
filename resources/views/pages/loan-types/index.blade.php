@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Loan Types'])

    <!-- Add Loan Type Button -->
    <div class="mb-6">
        <button onclick="openAddLoanTypeModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Loan Type
        </button>
    </div>

    <!-- Loan Types Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @include('pages.loan-types.partials.loan-type-table')
    </div>

    @include('pages.loan-types.partials.loan-type-modal')
    @include('pages.loan-types.partials.view-loan-type-modal')

@endsection
@push('scripts')
<script>
    // Modal Functions
    function openAddLoanTypeModal() {
        document.getElementById('modalTitle').textContent = 'Add New Loan Type';
        document.getElementById('loanTypeForm').reset();
        document.getElementById('loanTypeId').value = '';
        document.getElementById('loanTypeModal').classList.remove('hidden');
    }

    function closeLoanTypeModal() {
        document.getElementById('loanTypeModal').classList.add('hidden');
    }

    function closeViewLoanTypeModal() {
        document.getElementById('viewLoanTypeModal').classList.add('hidden');
    }

    // Loan Type Functions
    function viewLoanType(id) {
        const loanType = loanTypes.find(lt => lt.id === id);
        if (loanType) {
            document.getElementById('viewName').textContent = loanType.name;
            document.getElementById('viewDescription').textContent = loanType.description;
            document.getElementById('viewInterestRate').textContent = loanType.interest_rate;
            document.getElementById('viewStatus').textContent = loanType.is_active ? 'Active' : 'Inactive';
            document.getElementById('viewLoanTypeModal').classList.remove('hidden');
        }
    }

    function editLoanType(id) {
        const loanType = loanTypes.find(lt => lt.id === id);
        if (loanType) {
            document.getElementById('modalTitle').textContent = 'Edit Loan Type';
            document.getElementById('loanTypeId').value = loanType.id;
            document.getElementById('name').value = loanType.name;
            document.getElementById('description').value = loanType.description;
            document.getElementById('interest_rate').value = parseFloat(loanType.interest_rate);
            document.getElementById('is_active').value = loanType.is_active ? 'Active' : 'Inactive';
            document.getElementById('loanTypeModal').classList.remove('hidden');
        }
    }

    function deleteLoanType(id) {
        showAlert({
            title: 'Delete Loan Type',
            message: 'Are you sure you want to delete this loan type? This action cannot be undone.',
            confirmText: 'Delete',
            cancelText: 'Cancel',
            onConfirm: function() {
                fetch(`/loan-types/delete/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    throw new Error('Failed to save role');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to save loan. Please try again.');
            });
            }
        })
    }

    // Form Submission
    document.getElementById('loanTypeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            interest_rate: document.getElementById('interest_rate').value,
            is_active: document.getElementById('is_active').value === 'Active' ? true : false
        };
        const isEdit = document.getElementById('modalTitle').textContent === 'Edit Loan Type';
        const url = isEdit ? `/loan-types/${document.getElementById('loanTypeId').value}` : '/loan-types';
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
                closeLoanTypeModal();
                window.location.reload();
            } else {
                throw new Error('Failed to save role');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to save loan. Please try again.');
        });
    });

    const loanTypes = @json($loanTypes).data;
</script>
@endpush


