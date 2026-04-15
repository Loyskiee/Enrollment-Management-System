<?php

namespace App\Models;

use Database\Factories\RequirementsFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description'])]
class Requirement extends Model
{
    /** @use HasFactory<RequirementsFactory> */
    use HasFactory;

    public function studentRequirements(): HasMany
    {
        return $this->hasMany(StudentRequirement::class);
    }
}
