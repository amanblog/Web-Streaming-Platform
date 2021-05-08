<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Playlist extends Model
{
    use Notifiable;

    public function songs()
    {
        return $this->belongsToMany('App\Song');
    }
}
