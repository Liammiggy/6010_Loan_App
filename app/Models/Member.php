<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Member extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $year = Carbon::now()->year;
            $latest = DB::table('members')
                ->whereYear('created_at', $year)
                ->orderBy('id', 'desc')
                ->first();

            $nextNumber = 1;

            if ($latest && preg_match('/MEM-' . $year . '-(\d+)/', $latest->member_id, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            }

            $model->member_id = 'MEM-' . $year . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        });
    }
} 