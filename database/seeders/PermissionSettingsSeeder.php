<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'tenant.index']);
        Permission::create(['name' => 'tenant.view']);
        Permission::create(['name' => 'tenant.create']);
        Permission::create(['name' => 'tenant.update']);
        Permission::create(['name' => 'tenant.delete']);
        Permission::create(['name' => 'tenant.restore']);
        Permission::create(['name' => 'tenant.delete.force']);
        Permission::create(['name' => 'domain.index']);
        Permission::create(['name' => 'domain.view']);
        Permission::create(['name' => 'domain.create']);
        Permission::create(['name' => 'domain.update']);
        Permission::create(['name' => 'domain.delete']);
        Permission::create(['name' => 'domain.restore']);
        Permission::create(['name' => 'domain.delete.force']);
    }
}
