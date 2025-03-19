<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'pdf.index']);
        Permission::create(['name' => 'pdf.view']);
        Permission::create(['name' => 'pdf.create']);
        Permission::create(['name' => 'pdf.update']);
        Permission::create(['name' => 'pdf.update.password']);
        Permission::create(['name' => 'pdf.profiles.update']);
        Permission::create(['name' => 'pdf.delete']);
        Permission::create(['name' => 'pdf.restore']);
        Permission::create(['name' => 'pdf.delete.force']);
        Permission::create(['name' => 'txt.index']);
        Permission::create(['name' => 'txt.view']);
        Permission::create(['name' => 'txt.create']);
        Permission::create(['name' => 'txt.update']);
        Permission::create(['name' => 'txt.update.password']);
        Permission::create(['name' => 'txt.profiles.update']);
        Permission::create(['name' => 'txt.delete']);
        Permission::create(['name' => 'txt.restore']);
        Permission::create(['name' => 'txt.delete.force']);
        Permission::create(['name' => 'request.index']);
        Permission::create(['name' => 'request.view']);
        Permission::create(['name' => 'request.create']);
        Permission::create(['name' => 'request.update']);
        Permission::create(['name' => 'request.update.password']);
        Permission::create(['name' => 'request.profiles.update']);
        Permission::create(['name' => 'request.delete']);
        Permission::create(['name' => 'request.restore']);
        Permission::create(['name' => 'request.delete.force']);
    }
}
