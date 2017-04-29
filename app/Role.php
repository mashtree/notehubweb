<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

    public function user_to_note()
    {
    	return $this->hasMany('App\UserToNote');
    }
}
