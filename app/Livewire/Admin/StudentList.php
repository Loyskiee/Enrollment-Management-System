<?php

namespace App\Livewire\Admin;

use App\Enums\UserStatus;
use App\Models\User;
use Livewire\Component;

class StudentList extends Component
{

  public $filter = 'pending';
  
    public function approve($userId)
        {
            $user = User::find($userId);

            if ($user->status === UserStatus::Approved) return;

            $user->update(['status' => UserStatus::Approved]);
        }
    public function reject($userId)
    {
        $user = User::find($userId);

        if($user->status === UserStatus::Approved) return;

        $user->update(['status' => UserStatus::Rejected]);
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
