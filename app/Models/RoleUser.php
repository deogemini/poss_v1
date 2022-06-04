<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

 protected $table = "role_user";

    public function Role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


}
