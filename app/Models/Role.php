<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions')
            ->withTimestamps();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles')
            ->withTimestamps();
    }

    public function hasPermission(string $permissionSlug): bool
    {
        return $this->permissions()
            ->where('slug', $permissionSlug)
            ->exists();
    }

    public function assignPermission(string $permissionSlug): void
    {
        $permission = Permission::where('slug', $permissionSlug)->first();
        if ($permission) {
            $this->permissions()->syncWithoutDetaching($permission->id);
        }
    }

    public function revokePermission(string $permissionSlug): void
    {
        $permission = Permission::where('slug', $permissionSlug)->first();
        if ($permission) {
            $this->permissions()->detach($permission->id);
        }
    }

    public function getPermissionsByModule(): array
    {
        return $this->permissions()
            ->get()
            ->groupBy('module')
            ->toArray();
    }
} 