<?php
namespace App\Livewire\Student;

use App\Enums\RequirementSubmissionStatus;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Requirement;
use App\Models\RequirementSubmission;


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
     * files must be an array with minimum of 1
     *  Each item of the array must be pdf, jpg, or png.
     */
     #[Validate([
        'files' => 'required|array|min:1',
        'files.*' => 'nullable|file|mimes:pdf,jpg,png|max:5120'
        ])] 
    public $files = [];
                           
  
    public function uploadRequirements()
    {
        $this->validate();
        /**
         * Checks if the files empty, if empty throws an error
         * 
         * The $this->files is the key name, and the $requirementId is the key value
         * 
         * $path defines where the file is stored which is in 'requirements public'  
         */
       foreach($this->files as $requirementId => $file) {
            $path  = $file->store('requirements', 'public');

               RequirementSubmission::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'requirement_id' => $requirementId
            ],
            [
                'file_path' => $path,
                'status' =>  RequirementSubmissionStatus::Submitted->value,
                'is_onsite' => false,
                'admin_comment' => null
            ]
       );

       }
        $this->reset('files');
        session()->flash('message', 'Submissions saved successfully!');
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
