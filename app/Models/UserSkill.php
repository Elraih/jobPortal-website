<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    protected $table = "user_skill";
    protected $guarded = [];


    protected $casts =[
        'skills' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

