<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserToNote extends Model
{
    protected $table = 'users_to_notes';

    public function user()
    {
    	return $this->hasOne('App\User');
    }

    public function note()
    {
    	return $this->hasOne('App\Note');
    }

    public function role()
    {
    	return $this->hasOne('App\Role');
    }
}
