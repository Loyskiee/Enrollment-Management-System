<?php

namespace App\Enums;

enum EnrollmentStatus: String
{
    case Pending = 'pending';
    case Approved = 'approved'; 
    case Rejected = 'rejected';
}
