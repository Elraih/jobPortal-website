<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends =['created_at_human'];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->withTrashed()->where($field ?? 'id', $value)->firstOrFail();
    }
    
    protected function getCreatedAtHumanAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function contactInfo(){
        return $this->hasOne(ContactInfo::class);
    }

    public function companyProfile(){
        return $this->hasOne(CompanyProfile::class);
    }

    public function userProfile(){
        return $this->hasOne(UserProfile::class);  
    }

    public function jobPosts(){
        return $this->hasMany(JobPost::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class);
    }

    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function skill(){
        return $this->hasOne(UserSkill::class);
    }

    public function location(){
        return $this->hasOne(Location::class);
    }

    public function jobApplications(){
        return $this->hasMany(JobApplication::class);
    }

    public function resume(){
        return $this->hasOne(Resume::class);
    }


    public function scopeFilterCompanyName(Builder $query, $companyName){
        return $query->whereHas('companyProfile', function($q) use($companyName) {
            $q->where('name', 'like', "%$companyName%");
        });

    }


    

}
