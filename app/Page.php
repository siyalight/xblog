<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Lufficc\Comment\CommentHelper;

class Page extends Model
{
    protected $fillable = ['name', 'display_name', 'content', 'html_content'];

    use CommentHelper;

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function configuration()
    {
        return $this->morphOne(Configuration::class, 'configurable');
    }

}
