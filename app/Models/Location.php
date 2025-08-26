<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

     use HasFactory;
    protected $table = 'location';
    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }
}

