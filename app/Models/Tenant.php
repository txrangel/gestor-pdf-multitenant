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
use Illuminate\Support\Facades\File;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public function domains(): HasMany
    {
        return $this->hasMany(related: Domain::class);
    }

    public static function getCustomColumns(): array
    {
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

    public function setPasswordAttribute($value): string
    {
        return $this->attributes['password'] = Hash::make(value: $value);
    }

    protected static function boot()
    {
        parent::boot();
        /*
        // Cria os diretórios de cache e armazenamento quando o tenant é criado
        static::created(function ($tenant) {
            // Cria o diretório de cache do tenant
            $cachePath = storage_path("tenant{$tenant->id}/framework/cache");
            if (!file_exists($cachePath)) {
                mkdir($cachePath, 0755, true);
            }

            // Cria o diretório de armazenamento do tenant
            $storagePath = storage_path("tenant{$tenant->id}/app");
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0755, true);
            }
        });
        */
        // Exclui os diretórios de cache e armazenamento quando o tenant é excluído permanentemente
        static::deleting(function ($tenant) {
            // Exclui o arquivo de foto (se existir)
            if (Storage::disk('public')->exists($tenant->photo_path)) {
                Storage::disk('public')->delete($tenant->photo_path);
            }
            /*
            // Exclui o diretório de cache do tenant
            $cachePath = storage_path("tenant{$tenant->id}/framework/cache");
            if (file_exists($cachePath)) {
                File::deleteDirectory($cachePath);
            }

            // Exclui o diretório de armazenamento do tenant
            $storagePath = storage_path("tenant{$tenant->id}/app");
            if (file_exists($storagePath)) {
                File::deleteDirectory($storagePath);
            }

            // Exclui o diretório raiz do tenant
            $tenantRootPath = storage_path("tenant{$tenant->id}");
            if (file_exists($tenantRootPath)) {
                File::deleteDirectory($tenantRootPath);
            }*/
        });
    }
}