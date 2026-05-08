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
    User::firstOrCreate(
        ['email' => 'test@example.com'],
        [
            'name' => 'Test User',
            'status' => 'approved',
            'password' => bcrypt('password'),
        ]);

    User::firstOrCreate(
        ['email' => 'angel@example.com'],
        [
            'name' => 'Angel',
            'role' => 'admin',
            'status' => 'approved',
            'password' => bcrypt('password'),
        ]);

    User::firstOrCreate(
        ['email' => 'seancarlo@example.com'],
        [
            'name' => 'Sean Carlo',
            'status' => 'approved',
            'password' => bcrypt('password'),
        ]);

    // Soon magiging super admin
    User::firstOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Main Admin',
            'role' => 'admin',
            'status' => 'approved',
            'password' => bcrypt('password'),
        ]);

        $this->call([RequirementSeeder::class, SemesterSeeder::class]);
    }
}
