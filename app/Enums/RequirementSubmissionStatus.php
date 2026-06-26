<?php

namespace App\Enums;

enum RequirementSubmissionStatus: String
{
    case Submitted = 'submitted';
    case Approved =   'approved';
    case Rejected =   'rejected';
    
}
