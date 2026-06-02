<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class StudentList extends Component
{

  public $filter = 'pending';
  
  public function approve($userId)
    {
        User::where('id', $userId)
         ->update(['status' => 'approved']);
    }
    public function reject($userId)
    {
        User::where('id', $userId)
         ->update(['status' => 'rejected']);
    }
    public function render()
    {
         $students = User::where('role', 'student')
        ->when($this->filter !== 'all', fn($q) => $q->where('status', $this->filter))
        ->get();

        return view('livewire.admin.student-list' , [
                'students' => $students
        ]);
    }
}
