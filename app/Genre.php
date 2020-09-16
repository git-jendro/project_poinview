<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'uuid', 'name', 'description'
    ];

    public function album()
    {
        return $this->hasMany('App\Album');
    }
}
