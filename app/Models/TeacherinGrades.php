<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherinGrades extends Model
{

    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'grade_id',
    ];

    protected $table = "teacherin_grades";

    public function teachers(){
        return $this->belongto(School_Teachers::class, 'teacher_id');
    }

    public function grades(){
        return $this->belongto(Grade::class, 'grade_id');
    }
}
