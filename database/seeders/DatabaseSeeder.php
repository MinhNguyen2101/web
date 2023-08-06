<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(20)->create();
        \App\Models\Supplier::factory(20)->create();


        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 2
        ]);
        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'role' => 1
        ]);
    }
}
