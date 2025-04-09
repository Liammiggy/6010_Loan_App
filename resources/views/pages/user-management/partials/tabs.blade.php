<div class="mb-6">
    <div class="border-b border-gray-200">
        <div class="flex justify-between items-center">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button onclick="switchTab('users')" class="tab-button border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600" id="users-tab">
                    Users
                </button>
                <button onclick="switchTab('roles')" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" id="roles-tab">
                    Roles
                </button>
            </nav>
            <!-- User Add Button -->
            <button id="addUserBtn" onclick="openUserModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add New User
            </button>
            <!-- Role Add Button (Hidden by default) -->
            <button id="addRoleBtn" onclick="openRoleModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add New Role
            </button>
        </div>
    </div>
</div>