<?php

namespace App\Models;

use App\Models\User;
use App\Models\RequirementSubmission;
use Database\Factories\RequirementsFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'name', 'description', 'is_required'])]
class Requirement extends Model
{
    /** @use HasFactory<RequirementsFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   public function requirementSubmissions(): HasMany
    {
        return $this->hasMany(RequirementSubmission::class);
    }
}
