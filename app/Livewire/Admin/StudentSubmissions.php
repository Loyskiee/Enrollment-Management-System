<?php

namespace App\Livewire\Admin;

use App\Models\Requirement;
use Livewire\Component;
use App\Models\User;

/**
 * View all the students' requirements and view one by one
 */
class StudentSubmissions extends Component
{
    /**
     * Get all the approved students
     * 
     * Fetching the total numbers of requirements in the system
     */
    public function render()
    {
        $students = User::where('role', 'student')
        ->where('status', 'approved')
        ->withCount('requirements')
        ->get();

        $totalRequirements = Requirement::count();
        return view('livewire.admin.student-submissions', [
            'students' => $students,
            'totalRequirements' => $totalRequirements
        ]);
    }
}
