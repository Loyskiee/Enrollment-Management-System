<?php

namespace App\Models;

use Database\Factories\StudentRequirementFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'requirement_id', 'status', 'file_path', 'is_onsite'])]
class StudentRequirement extends Model
{
    /** @use HasFactory<StudentRequirementFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function requirement(): BelongsTo
    {
        return $this->belongsTo(Requirement::class);
    }
}
