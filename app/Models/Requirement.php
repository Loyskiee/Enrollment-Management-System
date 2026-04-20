<?php

namespace App\Models;

use Database\Factories\RequirementsFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'description', 'is_required'])]
class Requirement extends Model
{
    /** @use HasFactory<RequirementsFactory> */
    use HasFactory;

    public function students(): BelongsToMany
    {
        return $this->belongsToMany('User::class', 'student_requirements', 'requirement_id', 'user_id')
        ->withPivot(['file_path', 'status', 'is_onsite'])
        ->withTimestamps();
    }
}
