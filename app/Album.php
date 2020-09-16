<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'uuid', 'user_id','description','thumbnail',
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function song()
    {
        return $this->hasMany('App\Song');
    }

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
}
