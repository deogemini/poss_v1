<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;


class Region extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    /*
    One Region has many districts
    */
    public function districts(){
        return $this->hasMany(District::class);
    }
}
