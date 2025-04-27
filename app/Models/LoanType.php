<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'interest_rate',
        'is_active'
    ];

    protected $casts = [
        'interest_rate' => 'decimal:2',
        'is_active' => 'boolean'
    ];    

} 