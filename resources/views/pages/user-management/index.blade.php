@extends('layouts.app')

@section('content')
    @include('pages.components.header', ['title' => 'User & Roles Management'])
    
    <!-- Tabs -->
    @include('pages.user-management.partials.tabs')

    <!-- Users Table -->
    @include('pages.user-management.partials.users-table')

    <!-- Roles Table -->
    @include('pages.user-management.partials.roles-table')

    <!-- User Modal -->
    @include('pages.user-management.partials.users-modal')

    <!-- Role Modal -->
    @include('pages.user-management.partials.roles-modal')

@endsection

@push('scripts')
    <script>
        // Get active tab from URL parameter or default to 'users'
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'users';
        let role_id = null;

        // Initialize tabs on page load
        document.addEventListener('DOMContentLoaded', function() {
            switchTab(activeTab);
        });

        function switchTab(tab) {
            // Update URL without page reload
            const newUrl = new URL(window.location);
            newUrl.searchParams.set('tab', tab);
            window.history.pushState({}, '', newUrl);

            // Hide all panels
            document.querySelectorAll('.tab-panel').forEach(panel => {
                panel.classList.add('hidden');
            });
            
            // Show selected panel
            document.getElementById(`${tab}-panel`).classList.remove('hidden');
            
            // Update tab styles
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-blue-500', 'text-blue-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });
            
            document.getElementById(`${tab}-tab`).classList.add('border-blue-500', 'text-blue-600');
            document.getElementById(`${tab}-tab`).classList.remove('border-transparent', 'text-gray-500');

            // Toggle add buttons based on active tab
            const addUserBtn = document.getElementById('addUserBtn');
            const addRoleBtn = document.getElementById('addRoleBtn');
            
            if (tab === 'roles') {
                addUserBtn.classList.add('hidden');
                addRoleBtn.classList.remove('hidden');
            } else {
                addUserBtn.classList.remove('hidden');
                addRoleBtn.classList.add('hidden');
            }
        }

        function openUserModal() {
            document.getElementById('userModal').classList.remove('hidden');
        }

        function closeUserModal() {
            document.getElementById('userModal').classList.add('hidden');
        }

        function editUser(userId) {
            // Implement edit user logic
            openUserModal();
            // Fetch user data and populate form
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                // Implement delete user logic
            }
        }

        function openRoleModal() {
            document.getElementById('roleModal').classList.remove('hidden');
            document.getElementById('role-modal-title').textContent = 'Add New Role';
            document.getElementById('roleForm').reset();
        }

        function closeRoleModal() {
            document.getElementById('roleModal').classList.add('hidden');
        }

        function editRole(roleId) {
            
            // Fetch role data and populate form
            fetch(`/user-management/roles?id=${roleId}`)
                .then(response => response.json())
                .then(role => {
                    openRoleModal();
                    document.getElementById('role-modal-title').textContent = 'Edit Role';
                    role_id = roleId;
                    document.getElementById('role_name').value = role.name;
                    document.getElementById('role_description').value = role.description;
                    // Populate permissions
                    role.permissions.forEach(permission => {
                        const checkbox = document.getElementById(`${permission.slug}`);
                        if (checkbox) checkbox.checked = true;
                    });

                    
                })
                .catch(error => console.error('Error:', error));
        }

        function deleteRole(roleId) {
            if (confirm('Are you sure you want to delete this role? This action cannot be undone.')) {
                fetch(`/api/roles/${roleId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        throw new Error('Failed to delete role');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete role. Please try again.');
                });
            }
        }

        // Handle role form submission
        document.getElementById('roleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                name: document.getElementById('role_name').value,
                description: document.getElementById('role_description').value,
                permissions: Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
                    .map(checkbox => checkbox.id.replace('perm_', ''))
            };

            const isEdit = document.getElementById('role-modal-title').textContent === 'Edit Role';
            const url = isEdit ? `/user-management/roles/${role_id}` : '/user-management/roles';
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
                    window.location.reload();
                } else {
                    throw new Error('Failed to save role');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to save role. Please try again.');
            });
        });

        // Close modals when clicking outside
        window.onclick = function(event) {
            const userModal = document.getElementById('userModal');
            const roleModal = document.getElementById('roleModal');
            
            if (event.target == userModal) {
                closeUserModal();
            }
            if (event.target == roleModal) {
                closeRoleModal();
            }
        }
    </script>
@endpush


