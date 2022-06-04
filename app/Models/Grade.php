<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'school_id'
    ];

    protected $table = 'grades';


     /**
     * Get the streams for the Grade.
     */
    public function streams()
    {
        return $this->hasMany(Stream::class);
    }

     /**
     * Get the School that owns the grades.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
