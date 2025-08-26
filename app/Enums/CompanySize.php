<?php

namespace App\Enums;

enum CompanySize :string
{
    case Tiny =  '0-50';
    case Small =  '51-100';
    case Medium =  '101-500';
    case Big =  '501-1500';
    case Large =  '+1500';
    
    
    public static function keyValue(): array
    {
        return array_map(fn($case) => [
        'id' => $case->value,
        'name' => "{$case->name} ({$case->value})",
        ], self::cases());
    }
}