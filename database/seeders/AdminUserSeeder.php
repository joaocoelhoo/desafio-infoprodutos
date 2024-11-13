<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin']
        );

        User::firstOrCreate(
            [
              'name' => 'Admin User',
              'email' => 'admin@email.com',
              'password' => Hash::make('admin@123'),
              'role_id' => $adminRole->id,
            ]
        );
    }
}
