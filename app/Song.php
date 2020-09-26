<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'uuid', 'album_id','name','genre','lyric','description','song', 'slug'
    ];

    public function albums()
    {
        return $this->belongsTo('App\Album');
    }
}
