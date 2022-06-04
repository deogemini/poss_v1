<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'status',
        'remarks',
    ];

    
    /**
     * The users(teacher) that belong to the attendance.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

       /**
     * The attendance that belong to the student.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

}
