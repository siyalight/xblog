<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function category()
    {
        return $this->belongsTo('App\Post');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
