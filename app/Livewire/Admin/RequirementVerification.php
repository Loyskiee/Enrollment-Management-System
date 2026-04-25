<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\StudentRequirement;

/**
 * Accepts/Reject a students' requirements
 */
class RequirementVerification extends Component
{
    public User $user;

    public $notes = []; // This is a placeholder for comments

    public $message = '';

    public function mount(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * This update a student's requirement status
     *  e.g approved rejected
     * 
     * updateExistingPivot is used to modify extra columns 
     *  in BelongsToMany relationship
     * 
     *  ucfirst() is a method returns the given string with the 
     *    first character Capitalized
     *  e.g($name= Str::of('mike')->ucfirst(); )
     */
    public function updateStatus($requirementId, $status)
    {
        
        $comment = $this->notes[$requirementId] ?? null; // comment for a specific requirement

        $this->user->requirements()
        ->updateExistingPivot($requirementId,[
            'status' => $status,
            'admin_comment' => $comment
        ]);

       unset($this->notes[$requirementId]); // once it updates, the comments of admin got cleaned.

       $this->message = 'Requirement marked as ' . ucfirst($status);

       $this->dispatch('clear-message');
    }

    public function render()
    {
        /**
         * This get the requirements and pivot table
         *  file_path and status
         */
        $submissions = StudentRequirement::with('requirement')
            ->where('user_id', $this->user->id)
            ->get();
    
        return view('livewire.admin.requirement-verification', [
            'submissions' => $submissions
        ]);
    }
}
