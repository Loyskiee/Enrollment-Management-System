<?php

namespace App\Models;

use Database\Factories\StudentRequirementFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'requirement_id', 'status', 'file_path', 'is_onsite'])]
class StudentRequirement extends Model
{
    /** @use HasFactory<StudentRequirementFactory> */
    use HasFactory;

    public function requirement(): BelongsTo
    {
        return $this->belongsTo(Requirement::class);
    }
}
