<?php

namespace App\Enums;

enum Educations :string
{
    case HighSchoolDiploma = 'high school diploma';
    case AssociatesDegree = 'associates degree';
    case BachelorsDegree ='bachelors degree';
    case MastersDegree = 'masters degree';
    case DoctoralDegree = 'doctoral degree';
}
