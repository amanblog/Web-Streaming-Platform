<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Artist extends Model
{
    use Notifiable;
    protected $fillable = ['*'];
    public function songs()
    {
        return $this->belongsToMany('App\Song');
    }
}
