<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteChange extends Model
{
    protected $table = 'note_changes';

    public function user()
    {
    	return $this->hasOne('App\User');
    }

    public function note()
    {
    	return $this->hasOne('App\Note');
    }
}
