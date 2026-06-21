<?php

namespace App\Enums;

enum RequirementSubmissionStatus: String
{
    case Submitted = 'submitted';
    case Incomplete = 'incomeplete';
    case Complete =   'complete';
    case Approved =   'approved';
    case Rejected =   'rejected';
    
}
