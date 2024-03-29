<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'educationLevel',
        'ward_id',
    ];

      protected $hidden = ['created_at', 'updated_at'];

     /**
     * Get the grades for the school.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function streams(){
        return $this->hasManyThrough(Stream::class, Grade::class);
    }

    public function ward(){
        return $this->belongsTo(Ward::class);
    }

      /**
     * Get the users for the school.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function attendanceforStudent()
    {
        return $this->hasMany(AttendanceStudent::class);
    }

    public function teachers()
{
    return $this->belongsToMany(User::class, 'teachers/headTeachers_schools', 'school_id', 'user_id');
}


}
