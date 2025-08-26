<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    public function jobPosts(){
        return $this->hasMany(JobPost::class);
    }

    public function location(){
        return $this->hasOne(Location::class);
    }
}
