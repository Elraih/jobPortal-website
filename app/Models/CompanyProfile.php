<?php

namespace App\Models;

use App\Enums\CompanySize;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    public $guarded = [];
    

    protected function casts(){

        return [
            'company_size' => CompanySize::class,
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    
    
}
