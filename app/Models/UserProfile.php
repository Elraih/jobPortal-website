<?php

namespace App\Models;

use App\FullName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    use FullName, HasFactory;

    protected $appends = ['full_name'];

    public $guarded = [];


    public function user(){
        return $this->belongsTo(User::class);
    }
}

