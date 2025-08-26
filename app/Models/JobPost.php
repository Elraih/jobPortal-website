<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
     use HasFactory, SoftDeletes;
    public $guarded = [

    ];
    protected $appends = ['created_at_human'];

    protected $casts = [
        'skills' => 'array'
    ];

    // create slug for jobPost title 
    public static function boot(){
        parent::boot();

        static::creating(function (JobPost $jobPost) {
            $jobPost->slug = static::generateUniuqSlug($jobPost->title);
        }); 
    }

    //generate uniuq slug for jobPost title if its exsist
    public static function generateUniuqSlug($title){
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while(static::where('slug', $slug)->exists()){
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }
        return $slug;
    }

    public function getCreatedAtHumanAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }

    public function jobType(){
        return $this->belongsTo(JobType::class);
    }
    
    public function jobCategory(){
        return $this->belongsTo(JobCategory::class);
    }

    public function jobApplications(){
        return $this->hasMany(JobApplication::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->withTrashed()->where($field ?? 'id', $value)->firstOrFail();
    }


    public function scopeFilterKeyword(Builder $query, $keyword ){
        return $query->where('title','LIKE','%'. $keyword .'%');

    }

    public function scopeFilterLocation(Builder $query, $governorate){

        if (!empty($governorate)) {
            $query->whereIn('governorate_id', (array) $governorate);
        }
        return $query;
    }

    public function scopeFilterType(Builder $query, $jobType){

        if (!empty($jobType)) {
            $query->whereIn('job_type_id', (array) $jobType);
        }
        return $query;
    }

    public function scopeFilterCategory(Builder $query, $jobCategory){

        if(!empty($jobCategory)){
            $query->whereIn('job_category_id', (array) $jobCategory);
        }
        return $query;
    }


    
}
