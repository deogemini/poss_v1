<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','api_token', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




     /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * The attendances that belog to the user(teacher)
     */
    public function attendances(){
        return $this->belongsToMany(Attendance::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'teachers/headTeachers_schools', 'user_id', 'school_id');
    }


    public function wards()
    {
        return $this->belongsToMany(Ward::class, 'wardOfficers_wards', 'user_id', 'ward_id');
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'districtOfficers_districts', 'user_id', 'district_id');
    }





}
