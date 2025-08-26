<?php

namespace App\Enums;

enum UserRoles :string
{
    case Admin = 'admin';
    case JobSeeker = 'job_seeker';
    case Company = 'company';

}