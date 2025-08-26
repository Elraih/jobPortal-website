<?php

namespace App\Models;

use App\Enums\JobApplicationStatus;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    public $guarded = [

    ];

    protected function casts(){
        return [
            'jobApplicationStatus' => JobApplicationStatus::class,
        ];
    }

    protected $table = 'job_applications';

    protected $appends = ['created_at_human'];


    public function getCreatedAtHumanAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function jobPost(){
        return $this->belongsTo(JobPost::class)->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function resume(){
        return $this->belongsTo(Resume::class);
    }

    public function scopeFilterName(Builder $query, $name){

        if(!empty($name)){
            $query->whereHas('user.userProfile', function($q) use($name) {
                $q->where('first_name', 'like', "%$name%");
            });
            return $query;
        }
    }

    public function scopeFilterStatus(Builder $query, $status){
        if(!empty($status)){
            $query->where('status', $status);
        }
        return $query;
    }
    
    
}
