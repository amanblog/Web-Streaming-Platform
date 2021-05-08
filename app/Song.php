<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Song extends Model
{
    use Notifiable;

    public function artists()
    {
        return $this->belongsToMany('App\Artist');
    }

    public function albums(){
        return $this->belongsToMany('App\Album');
    }

    public function genres(){
        return $this->belongsToMany('App\Genre');
    }

    public function chart(){
        return $this->belongsTo('App\Chart');
    }

    public function playlists()
    {
        return $this->belongsToMany('App\Playlist');
    }
}

