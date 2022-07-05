<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officers_Districts extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;


    protected $table = "districtOfficers_districts";

    public function user(){
        return $this->belongto(User::class, 'user_id');
    }
    public function district(){
        return $this->belongto(District::class, 'district_id');
    }
    public function region(){
        return $this->belongsToThrough(Region::class, District::class);
    }
}
