<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'uuid','category_id','slug','heading','body','status'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
