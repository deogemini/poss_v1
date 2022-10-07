<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Head_Teachers extends Model
{
    use HasFactory;

    protected $table = "teachers/headTeachers_schools";

    public function users(){
        return $this->belongto(User::class, 'user_id');
    }

    public function schools(){
        return $this->belongto(School::class, 'school_id');
    }

}
