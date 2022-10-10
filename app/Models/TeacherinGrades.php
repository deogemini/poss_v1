<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherinGrades extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'grade_id',
    ];

    protected $table = "teacherin_grades";

    public function users(){
        return $this->belongto(User::class, 'user_id');
    }

    public function grades(){
        return $this->belongto(Grade::class, 'grade_id');
    }
}
