<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\School;


class Student extends Model
{

    use \Znck\Eloquent\Traits\BelongsToThrough;

    use HasFactory;
    public $appends = ['grade'];
    protected $fillable = [
        'student_name',
        'gender',
        'stream_id',
        'school_id',
        'final_year_id'
    ];

    public function getGradeAttribute($school_id){
        if (isset($this->attributes['school_id'])) {
        $school = School::where('id', $this->attributes['school_id'])->first();
        $schoolevel = $school->educationLevel;
        if( $schoolevel === 'Secondary'){
         return $this->secondary();
        }else{
         return $this->primary();
        }
        }

    }

    public function secondary(){

        if (array_key_exists('final_year_id', $this->attributes)) {
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


            return "";
        }
    }

    public function primary(){

        if (array_key_exists('final_year_id', $this->attributes)) {
        $finalYear = FinalYears::find($this->attributes['final_year_id']);

        $current_year = (int) Date('Y');

        $level = ($finalYear->year - $current_year);

        switch($level){

            case 6:
            return "Standard One";

            case 5:
            return "Standard Two";

            case 4:
            return "Standard Three";

            case 3:
            return "Standard Four";

            case 2:
            return "Standard Five";

            case 1:
            return "Standard Six";

            default:
                return "Standard Seven";
        }
            return "";
        }

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

    public function grade(){
        return $this->belongsToThrough(Grade::class, Stream::class );
    }


}
