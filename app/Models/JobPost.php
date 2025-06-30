<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    public $guarded = [

    ];

    public function scopeFilter(Builder $query, array $filters ){
        return $query
        ->when($filters['keyword']?? null, function($q, $keyword){
            $q->where('title', 'like', "%$keyword%");
        });
    }



    
}
