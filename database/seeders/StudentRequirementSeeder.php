<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Requirement;
use App\Models\RequirementSubmission;
use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', UserRole::Student)->get();
        $requirements = Requirement::all();

        foreach ($students as $student) {
            foreach ($requirements as $requirement) {
                RequirementSubmission::firstOrCreate([
                    'user_id' => $student->id,
                    'requirement_id' => $requirement->id,
                ], [
                    'status' => 'submitted',
                    'file_path' => 'seeded/fake-document.pdf',
                    'is_onsite' => false,
                ]);
            }
        }
    }
}
