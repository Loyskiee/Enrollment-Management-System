<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'email', 'password', 'role', 'status'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * A student has many requirements 
     *  (inverse relationship with requirement)
     * 
     * The student_requirement is a pivot 
     *  since student_requirements needs a user id and requirement id
     */
    public function requirements():BelongsToMany
    {
        return $this->belongsToMany(Requirement::class, 'student_requirements', 'user_id', 'requirement_id')
        ->withPivot(['file_path', 'status', 'is_onsite', 'admin_comment'])
        ->withTimestamps();
    }

    // A student can enroll to a many semeter
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }

   
    public function isApproved():bool
    {
        // This counts all of the requirements 
        $totalRequirements = Requirement::count();

        // Looks for approved status in the requirements
        $approvedCount = $this->requirements()
        ->wherePivot('status', 'approved')->count();

        return $approvedCount === $totalRequirements;
    }

    /**
     * Method used to enroll a student
     */
    public function enroll()
    {
        // Finds active semester
        $activeSemester = Semester::where('is_active', true)
        ->first();

        // Logs an error that they forgot to set an active semester
        if(!$activeSemester) {
            return false;
        }

        // Create or update the enrollment record
        return $this->enrollments()->updateOrCreate(
            ['semester_id' => $activeSemester->id], 
            ['status' => 'approved']
        );
    }

    /**
     * Method used to check if the student has an approved
     *  enrollment for  the current active semester.
     */
    public function isEnrolled():bool
    {
        
        $activeSemester = Semester::where('is_active', true)->first();

        if (!$activeSemester) {
            return false;
        }
         
        return $this->enrollments()->where('semester_id', $activeSemester->id)
        ->where('status', 'approved')->exists();
    }
}
