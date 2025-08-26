<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    public function jobPosts(){
        return $this->hasMany(JobPost::class);
    }
}
