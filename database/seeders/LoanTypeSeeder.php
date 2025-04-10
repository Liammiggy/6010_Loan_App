<?php

namespace Database\Seeders;

use App\Models\LoanType;
use Illuminate\Database\Seeder;

class LoanTypeSeeder extends Seeder
{
    public function run()
    {
        $loanTypes = [
            [
                'name' => 'Personal Loan',
                'description' => 'A flexible loan that can be used for various personal needs such as home improvements, medical expenses, or debt consolidation.',
                'interest_rate' => 20.00,
                'is_active' => true
            ],
            [
                'name' => 'Education Loan',
                'description' => 'Designed to help students and their families cover the costs of education, including tuition, books, and living expenses.',
                'interest_rate' => 20.00,
                'is_active' => true
            ],
            [
                'name' => 'Retirement Loan',
                'description' => 'A loan product specifically designed for retirees to help them manage their finances during retirement.',
                'interest_rate' => 20.00,
                'is_active' => true
            ]
        ];

        foreach ($loanTypes as $loanType) {
            LoanType::create($loanType);
        }
    }
} 