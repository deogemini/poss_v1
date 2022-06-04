<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'grade_id'
    ];

    protected $table = 'streams';
    /**
     * Get the students for the class stream.
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get the Grade that owns the stream.
     */
    public function grades()
    {
        return $this->belongsTo(Grade::class);
    }
}
