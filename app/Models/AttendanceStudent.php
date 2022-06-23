<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceStudent extends Model
{
    use HasFactory;
    protected $table = 'attendance_student';
    protected $with = ['student'];

    public function student()
    {
        return $this->belongsTo("App\Models\Student");
    }
}
