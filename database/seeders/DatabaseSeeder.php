<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();
        $this->call(AdminUserSeeder::class);
        Category::factory(3)->create();
        Item::factory(8)->create();
        Purchase::factory(3)->create();
        Role::factory(3)->create();
    }
}
