<?php

namespace App\Models;

use App\Enums\RequirementSubmissionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Models\Requirement;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'requirement_id', 'status', 'admin_comment', 'file_path', 'is_onsite'])]
class RequirementSubmission extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     public function requirement(): BelongsTo
    {
        return $this->belongsTo(Requirement::class);
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

      protected function casts(): array
    {
        return [
           'status' => RequirementSubmissionStatus::class
        ];
    }
}
