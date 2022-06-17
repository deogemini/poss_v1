<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_name',
        'gender',
        'stream_id'                                                                                                              
    ];


     /**
     * The students that belong to the attendance.
     */
    public function attendanceStudent()
    {
        return $this->belongsToMany(AttendanceStudent::class);
    }

     /**
     * Get the stream that owns the student.
     */
    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }

    public function grade(){
        return $this->belongsToThrough(Grade::class, Stream::class );
    }
}
