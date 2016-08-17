<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','description','category_id','user_id','content','published'];

    public function category()
    {
        return $this->belongsTo('App\Post');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
