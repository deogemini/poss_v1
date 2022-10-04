<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School_Teachers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_id',
        'grade_id'
    ];

    protected $table = "school_teachers";

    public function users(){
        return $this->belongto(User::class, 'user_id');
    }

    public function schools(){
        return $this->belongto(School::class, 'school_id');
    }

    public function grades(){
        return $this->belongto(Grade::class, 'grade_id');
    }
}
