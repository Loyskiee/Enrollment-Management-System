<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $first_semester = Semester::create([
        'name' => '1st Semester',
        'is_active' => true,
      ]);

      $second_semester = Semester::create([
        'name' => '2nd Semester',
        'is_active' => false,
      ]);
    }
}
