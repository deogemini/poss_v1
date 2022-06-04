<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ward;


class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'region_id'
    ];

    protected $table = 'districts';

    /*
     one district has many wards
     */
     public function wards(){
        return $this->hasMany(Ward::class);
     }

     
    public function districtOfficers()
    {
        return $this->belongsToMany(User::class, 'districtOfficers_districts', 'user_id', 'ward_id');
    }



}
