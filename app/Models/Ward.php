<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\School;


class Ward extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'district_id'
    ];
    

    protected $table = 'wards';



    //one ward has many schools 
    public function schools(){
        return  $this->hasMany(School::class);

    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function wardOfficers()
    {
        return $this->belongsToMany(User::class, 'wardOfficers_wards',  'user_id', 'ward_id');
    }
}
