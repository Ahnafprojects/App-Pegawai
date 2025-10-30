<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // Membuat 30 users
        // User::factory(30)->create();

        // // Membuat user khusus untuk testing
        // User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@pegawai.com',
        // ]);
        
        // User::factory()->create([
        //     'name' => 'Test User',  
        //     'email' => 'testuser@pegawai.com',
        // ]);

        // Membuat 40 data employees
        Employee::factory(40)->create();
    }
}
