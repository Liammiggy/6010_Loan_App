<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        foreach (Permission::getDefaultPermissions() as $permission) {
            Permission::create($permission);
        }

        // Create Administrator role with all permissions
        $adminRole = Role::create([
            'name' => 'Administrator',
            'description' => 'Has full access to all features and settings',
            'is_active' => true
        ]);

        $adminRole->permissions()->attach(Permission::pluck('id'));

        // Create Loan Officer role with specific permissions
        $loanOfficerRole = Role::create([
            'name' => 'Loan Officer',
            'description' => 'Can view members, loans, and process loan applications',
            'is_active' => true
        ]);

        $loanOfficerPermissions = [
            'members_view',
            'loan_apps_view',
            'loan_apps_create',
            'loan_apps_verify',
            'loan_docs_manage',
            'payments_view',
            'payments_record'
        ];

        foreach ($loanOfficerPermissions as $permissionSlug) {
            $permission = Permission::where('slug', $permissionSlug)->first();
            if ($permission) {
                $loanOfficerRole->permissions()->attach($permission->id);
            }
        }

        // Create Loan Processor role
        $processorRole = Role::create([
            'name' => 'Loan Processor',
            'description' => 'Can process and verify loan applications',
            'is_active' => true
        ]);

        $processorPermissions = [
            'loan_apps_view',
            'loan_apps_verify',
            'loan_docs_manage'
        ];

        foreach ($processorPermissions as $permissionSlug) {
            $permission = Permission::where('slug', $permissionSlug)->first();
            if ($permission) {
                $processorRole->permissions()->attach($permission->id);
            }
        }

        // Create Loan Approver role
        $approverRole = Role::create([
            'name' => 'Loan Approver',
            'description' => 'Can approve or reject loan applications',
            'is_active' => true
        ]);

        $approverPermissions = [
            'loan_apps_view',
            'loan_apps_approve'
        ];

        foreach ($approverPermissions as $permissionSlug) {
            $permission = Permission::where('slug', $permissionSlug)->first();
            if ($permission) {
                $approverRole->permissions()->attach($permission->id);
            }
        }

        // Create Member Service role
        $memberServiceRole = Role::create([
            'name' => 'Member Service',
            'description' => 'Can manage member information and records',
            'is_active' => true
        ]);

        $memberServicePermissions = [
            'members_view',
            'members_create',
            'members_edit',
            'members_status',
            'members_history'
        ];

        foreach ($memberServicePermissions as $permissionSlug) {
            $permission = Permission::where('slug', $permissionSlug)->first();
            if ($permission) {
                $memberServiceRole->permissions()->attach($permission->id);
            }
        }

        // Create Accountant role
        $accountantRole = Role::create([
            'name' => 'Accountant',
            'description' => 'Can manage payments and financial records',
            'is_active' => true
        ]);

        $accountantPermissions = [
            'loan_apps_view',
            'payments_view',
            'payments_record',
            'fees_manage',
            'balance_adjust'
        ];

        foreach ($accountantPermissions as $permissionSlug) {
            $permission = Permission::where('slug', $permissionSlug)->first();
            if ($permission) {
                $accountantRole->permissions()->attach($permission->id);
            }
        }

        // Create Auditor role
        $auditorRole = Role::create([
            'name' => 'Auditor',
            'description' => 'Can view all records and generate reports',
            'is_active' => true
        ]);

        $auditorPermissions = [
            'members_view',
            'loan_apps_view',
            'payments_view'
        ];

        foreach ($auditorPermissions as $permissionSlug) {
            $permission = Permission::where('slug', $permissionSlug)->first();
            if ($permission) {
                $auditorRole->permissions()->attach($permission->id);
            }
        }

        // Create Branch Manager role
        $branchManagerRole = Role::create([
            'name' => 'Branch Manager',
            'description' => 'Can manage staff and approve loans',
            'is_active' => true
        ]);

        $branchManagerPermissions = [
            'members_view',
            'loan_apps_view',
            'loan_apps_approve',
            'payments_view'
        ];

        foreach ($branchManagerPermissions as $permissionSlug) {
            $permission = Permission::where('slug', $permissionSlug)->first();
            if ($permission) {
                $branchManagerRole->permissions()->attach($permission->id);
            }
        }

        // Create IT Support role
        $itSupportRole = Role::create([
            'name' => 'IT Support',
            'description' => 'Can manage system settings and user accounts',
            'is_active' => true
        ]);

        $itSupportPermissions = [
            'users_view',
            'users_create',
            'users_edit',
            'users_delete'
        ];

        foreach ($itSupportPermissions as $permissionSlug) {
            $permission = Permission::where('slug', $permissionSlug)->first();
            if ($permission) {
                $itSupportRole->permissions()->attach($permission->id);
            }
        }

        // Create Customer Service role
        $customerServiceRole = Role::create([
            'name' => 'Customer Service',
            'description' => 'Can view members and loans, provide basic support',
            'is_active' => true
        ]);

        $customerServicePermissions = [
            'members_view',
            'loan_apps_view',
            'payments_view'
        ];

        foreach ($customerServicePermissions as $permissionSlug) {
            $permission = Permission::where('slug', $permissionSlug)->first();
            if ($permission) {
                $customerServiceRole->permissions()->attach($permission->id);
            }
        }
    }
} 