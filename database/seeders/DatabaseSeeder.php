<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Admin']);
        $viewer = Role::create(['name' => 'Viewer']);

        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@absen.com',
            'password' => bcrypt('mypassword'),
        ]);

        $viewerUser = User::create([
            'name' => 'Viewer',
            'email' => 'viewer@absen.com',
            'password' => bcrypt('password'),
        ]);

        $adminUser->assignRole('Admin');
        $viewerUser->assignRole('Viewer');
    }
}
