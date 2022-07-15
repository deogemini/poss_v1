<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Znck\Eloquent\Traits\BelongsToThrough;


class Stream extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;


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
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function school(){
        return $this->belongsToThrough(School::class, Grade::class);
    }
}
