<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FullDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ProfileSeeder::class,
            PermissionSeeder::class,
            PermissionSettingsSeeder::class,
            UserSeeder::class,
            ProfilePermissionSeeder::class,
        ]);
    }
}
