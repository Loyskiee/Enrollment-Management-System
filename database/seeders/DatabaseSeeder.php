<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RequirementSeeder;
use Database\Seeders\SemesterSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'status' => 'approved'
        ]);

        User::create([
            'name' => 'Angel',
            'email' => 'angel@example.com',
            'role' => 'admin',
            'status' => 'approved',
            'password' => bcrypt('password') 
        ]);

        User::create([
            'name' => 'Sean Carlo',
            'email' => 'seancarlo@example.com',
            'status' => 'approved',
            'password' => bcrypt('password') 
        ]);

        // This will be a super_admin soon
        User::create([
            'name' => 'Main Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'status' => 'approved',
            'password' => bcrypt('password')
         ]);


        $this->call([RequirementSeeder::class, SemesterSeeder::class]);
    }
}
