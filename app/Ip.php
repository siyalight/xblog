<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    public $timestamps = false;
    protected $fillable = ['id'];
    public $incrementing = false;
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
