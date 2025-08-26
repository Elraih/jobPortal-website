<?php

namespace App\Enums;


enum JobApplicationStatus :string
{
    case Pending = 'pending';
    case Reviewed = 'reviewed';
    case InConsideration ='in consideration';
    case Rejected = 'rejected';


    public static function keyValue(): array
    {
        return array_map(fn($case) => [
        'id' => $case->value,
        'name' => "{$case->name}",
        ], self::cases());
    }
}
