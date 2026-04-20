<?php

namespace App\Livewire\Student;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Requirement;
use App\Models\StudentRequirement;

/**
 * Requirements:
 * Grade 11 Card
 *  Grade 12 Card
 * Good Moral
 * PSA Birth Cert
 * 2pcs. of 2x2 Picture (White background, collared shirt, with name tag)
 */
class RequirementList extends Component
{
    use WithFileUploads;

    /**
     * 
     */
    public $file; 
                            

    public function uploadRequirements($requirementId)
    {
        /**
         * This validates the file 
         *  mimes is a validation rule that ensure upload files must match
         *      specific allow MIME types by inspecting the file content.
         */
        $this->validate([
            'file' => 'required|file|mimes:pdf,jpg,png|max:5120',
        ]);

        /**
         * $path refers to the files array variable that contatins the requirements.
         *   the validated files goes to storage/app/puublic/requirements directory.
         * 
         */
        $path = $this->file->store('requirements', 'public'); // the requirement file is stored inside the public directory

       
        StudentRequirement::updateOrCreate(
            [
                'user_id' => Auth::id(), //authenticated user
                'requirement_id' => $requirementId, //requirements 
            ], 
            [
                'file_path' => $path,
                'status' => 'submitted',
                'is_onsite' => false,
            ]
        );
        
        $this->reset('file');// This resets the file and ready it for the next upload
        session()->flash('message', 'Requirement submitted successfuly!');
    }

    /**
     * This method renders(shows) the requirements and submission
     */
    public function render()
    {
        /**
         * Create a map of [requirement_id => status]
         * 
         * pluck() is a method used to retrieve all values
         *  for a specific key in a collection.
         *  e.g ($names = User::pluck('name') ) 
         * This return all the name values in User.
         */
        $studentSubmissions = Auth::user()->requirements()
        ->pluck('status', 'requirement_id');

        return view('livewire.student.requirement-list', [
            'requirements' => Requirement::all(),
            'studentSubmissions' => $studentSubmissions
        ]);
    }
}
