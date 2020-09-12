<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'uuid','name','status'
    ];

    public function thread()
    {
        return $this->hasMany('App\Thread');
    }
}
