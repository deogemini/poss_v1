<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    use \Znck\Eloquent\Traits\BelongsToThrough;

    use HasFactory;
    protected $appends = ['grade'];
    protected $fillable = [
        'student_name',
        'gender',
        'stream_id',                                                                                                              
        'school_id',                                                                                                              
        'final_year_id'                                                                                                              
    ];

    public function getGradeAttribute(){
        $finalYear = FinalYears::find($this->attributes['final_year_id']);

        $current_year = (int) Date('Y');

        $level = ($finalYear->year - $current_year);

        switch($level){

            case 3:
            return "Form One";

            case 2:
            return "Form Two";

            case 1:
            return "Form Three";

            default:
                return "Form Four";
        }
    }

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
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function finalYear()
    {
        return $this->belongsTo(FinalYears::class);
    }
    // public function school()
    // {
    //     return $this->belongsTo(School::class);
    // }

    public function grade(){
        return $this->belongsToThrough(Grade::class, Stream::class );
    }
 
  
}
