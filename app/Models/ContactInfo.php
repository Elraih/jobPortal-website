<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    public $guarded = [];



    public function User(){
        return $this->belongsTo(User::class);
    }
}
