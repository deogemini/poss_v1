<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    protected $table = 'grades';

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacherin_grades', 'user_id', 'grade_id');
    }

}
