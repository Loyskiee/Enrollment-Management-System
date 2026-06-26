<?php

namespace App\Models;

use App\Enums\EnrollmentStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

#[Fillable('user_id', 'semester_id', 'status')]
class Enrollment extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function requirementSubmissions(): HasMany
    {
        return $this->hasMany(RequirementSubmission::class);
    }

      protected function casts(): array
    {
        return [
           'status' => EnrollmentStatus::class
        ];
    }

    /**
     * Checks if the student is approved
     * 
     */
    public function approved():bool
    {
        // get all the requirements
       $totalRequirements = Requirement::where('is_required', true)->count();

        // check the approved requirements and count it.
        $approvedCount = RequirementSubmission::where('user_id', $this->user_id)
        ->where('status', 'approved')
        ->count();
        
        return $approvedCount === $totalRequirements;

    }
}
