<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable('user_id', 'semester_id', 'status')]
class Enrollment extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentFactory> */
    use HasFactory;
}
