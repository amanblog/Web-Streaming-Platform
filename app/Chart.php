<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    public function song()
    {
        return $this->hasOne('App\Song', 'song_id');
    }
}
