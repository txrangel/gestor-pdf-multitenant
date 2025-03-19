<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'profile.index']);
        Permission::create(['name' => 'profile.view']);
        Permission::create(['name' => 'profile.create']);
        Permission::create(['name' => 'profile.update']);
        Permission::create(['name' => 'profile.permissions.update']);
        Permission::create(['name' => 'profile.delete']);
        Permission::create(['name' => 'profile.restore']);
        Permission::create(['name' => 'profile.delete.force']);
        Permission::create(['name' => 'permission.index']);
        Permission::create(['name' => 'permission.view']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.update']);
        Permission::create(['name' => 'permission.delete']);
        Permission::create(['name' => 'permission.restore']);
        Permission::create(['name' => 'permission.delete.force']);
        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.view']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.update.password']);
        Permission::create(['name' => 'user.profiles.update']);
        Permission::create(['name' => 'user.delete']);
        Permission::create(['name' => 'user.restore']);
        Permission::create(['name' => 'user.delete.force']);
    }
}
