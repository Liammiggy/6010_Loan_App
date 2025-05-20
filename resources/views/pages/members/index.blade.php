@extends('layouts.app')

@section('content')

    @include('pages.components.header', ['title' => 'Members'])

    @include('pages.members.partials.member-table')
    @include('pages.members.partials.member-modal')
    @include('pages.members.partials.member-view-modal')    

@push('scripts')
<script>
    // Modal Functions
    function openAddMemberModal() {
        document.getElementById('modalTitle').textContent = 'Add New Member';
        document.getElementById('memberForm').reset();
        document.getElementById('memberId').value = '';
        document.getElementById('memberModal').classList.remove('hidden');
    }

    function closeMemberModal() {
        document.getElementById('memberModal').classList.add('hidden');
    }

    function closeViewMemberModal() {
        document.getElementById('viewMemberModal').classList.add('hidden');
    }

    // Member Functions
    function viewMember(id) {
        const member = members.find(m => m.id === id);
        if (member) {
            document.getElementById('viewName').textContent = member.name;
            document.getElementById('viewEmail').textContent = member.email;
            document.getElementById('viewPhone').textContent = member.phone;
            document.getElementById('viewAddress').textContent = member.address;
            document.getElementById('viewStatus').textContent = member.status;
            document.getElementById('viewJoinDate').textContent = member.join_date;
            document.getElementById('viewMemberModal').classList.remove('hidden');
        }
    }

    function editMember(id) {
        const member = members.find(m => m.id === id);
        if (member) {
            document.getElementById('modalTitle').textContent = 'Edit Member';
            document.getElementById('memberId').value = member.id;
            document.getElementById('name').value = member.name;
            document.getElementById('email').value = member.email;
            document.getElementById('phone').value = member.phone;
            document.getElementById('address').value = member.address;
            document.getElementById('is_active').value = member.is_active ? 'Active' : 'Inactive';
            document.getElementById('memberModal').classList.remove('hidden');
        }
    }

    function deleteMember(id) {
        showAlert({
            title: 'Delete Member',
            message: 'Are you sure you want to delete this member? This action cannot be undone.',
            confirmText: 'Delete',
            cancelText: 'Cancel',
            onConfirm: function() {
                fetch(`/members/delete/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        throw new Error('Failed to delete user');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert({
                        title: 'Error',
                        message: 'Failed to delete user. Please try again.',
                        confirmText: 'OK',
                        cancelText: null,
                        onConfirm: function() {
                            closeAlert();
                        }
                    });
                });
            }
        });
    }

    // Form Submission
    document.getElementById('memberForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            id: document.getElementById('memberId').value,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value,
            is_active: document.getElementById('is_active').value == 'Active' ? true : false
        };
        const isEdit = document.getElementById('modalTitle').textContent === 'Edit Member';
        const url = isEdit ? `/members/${document.getElementById('memberId').value}` : '/members';
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
                closeMemberModal();
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

    // Store members data for JavaScript functions
    const members = @json($members).data;
</script>
@endpush
@endsection


