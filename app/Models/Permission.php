<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'module',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permissions')
            ->withTimestamps();
    }

    public static function getModules(): array
    {
        return [
            'user_management' => 'User & Role Management',
            'member_management' => 'Member Management',
            'loan_type_management' => 'Loan Type Management',
            'loan_application' => 'Loan Application',
            'disbursement_repayment' => 'Disbursement & Repayment',
            'payment_transaction' => 'Payment & Transaction'
        ];
    }

    public static function getDefaultPermissions(): array
    {
        return [
            // User & Role Management
            [
                'name' => 'View Users',
                'slug' => 'users_view',
                'module' => 'user_management'
            ],
            [
                'name' => 'Create Users',
                'slug' => 'users_create',
                'module' => 'user_management'
            ],
            [
                'name' => 'Edit Users',
                'slug' => 'users_edit',
                'module' => 'user_management'
            ],
            [
                'name' => 'Delete Users',
                'slug' => 'users_delete',
                'module' => 'user_management'
            ],
            [
                'name' => 'Manage Roles & Permissions',
                'slug' => 'roles_manage',
                'module' => 'user_management'
            ],

            // Member Management
            [
                'name' => 'View Members',
                'slug' => 'members_view',
                'module' => 'member_management'
            ],
            [
                'name' => 'Add Members',
                'slug' => 'members_create',
                'module' => 'member_management'
            ],
            [
                'name' => 'Edit Members',
                'slug' => 'members_edit',
                'module' => 'member_management'
            ],
            [
                'name' => 'Activate/Deactivate Members',
                'slug' => 'members_status',
                'module' => 'member_management'
            ],
            [
                'name' => 'View Loan History',
                'slug' => 'members_history',
                'module' => 'member_management'
            ],

            // Loan Type Management
            [
                'name' => 'View Loan Types',
                'slug' => 'loan_types_view',
                'module' => 'loan_type_management'
            ],
            [
                'name' => 'Create Loan Types',
                'slug' => 'loan_types_create',
                'module' => 'loan_type_management'
            ],
            [
                'name' => 'Edit Loan Types',
                'slug' => 'loan_types_edit',
                'module' => 'loan_type_management'
            ],
            [
                'name' => 'Delete Loan Types',
                'slug' => 'loan_types_delete',
                'module' => 'loan_type_management'
            ],

            // Loan Application
            [
                'name' => 'View Applications',
                'slug' => 'loan_apps_view',
                'module' => 'loan_application'
            ],
            [
                'name' => 'Create Applications',
                'slug' => 'loan_apps_create',
                'module' => 'loan_application'
            ],
            [
                'name' => 'Verify Applications',
                'slug' => 'loan_apps_verify',
                'module' => 'loan_application'
            ],
            [
                'name' => 'Approve/Reject Applications',
                'slug' => 'loan_apps_approve',
                'module' => 'loan_application'
            ],
            [
                'name' => 'Manage Documents',
                'slug' => 'loan_docs_manage',
                'module' => 'loan_application'
            ],

            // Disbursement & Repayment
            [
                'name' => 'Disburse Loans',
                'slug' => 'loan_disburse',
                'module' => 'disbursement_repayment'
            ],
            [
                'name' => 'Manage Repayment Schedules',
                'slug' => 'repayment_schedule',
                'module' => 'disbursement_repayment'
            ],
            [
                'name' => 'Update Loan Status',
                'slug' => 'loan_status',
                'module' => 'disbursement_repayment'
            ],

            // Payment & Transaction
            [
                'name' => 'Record Payments',
                'slug' => 'payments_record',
                'module' => 'payment_transaction'
            ],
            [
                'name' => 'View Transactions',
                'slug' => 'payments_view',
                'module' => 'payment_transaction'
            ],
            [
                'name' => 'Manage Fees & Penalties',
                'slug' => 'fees_manage',
                'module' => 'payment_transaction'
            ],
            [
                'name' => 'Adjust Balances',
                'slug' => 'balance_adjust',
                'module' => 'payment_transaction'
            ]
        ];
    }
} 