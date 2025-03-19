<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Support\Facades\Storage;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains/*,SoftDeletes*/;

    public function domains(): HasMany{
        return $this->hasMany(related: Domain::class);
    }

    public static function getCustomColumns(): array{
        return [
            'id',
            'name',
            'email',
            'password',
            'photo_path',
            'primary_color',
            'secundary_color'
        ];
    }

    protected $hidden = [
        'email',
        'password',
        'remember_token'
    ];

    public function setPasswordAttribute($value): string{
        return $this->attributes['password'] = Hash::make(value: $value);
    }

    protected static function boot()
    {
        parent::boot();
    
        static::deleting(function ($tenant) {
            // Excluir o arquivo
            if (Storage::disk('public')->exists($tenant->photo_path)) {
                Storage::disk('public')->delete($tenant->photo_path);
            }
        });
    }
}