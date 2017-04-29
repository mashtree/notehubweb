<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    public function user()
    {
    	return $this->hasOne('App\User');
    }

    public function user_to_note()
    {
    	return $this->hasMany('App\UserToNote');
    }

    public function note_change()
    {
    	return $this->hasMany('App\NoteChange');
    }
}
