<?php

namespace App;

use App\Scopes\ObjectTypeScope;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ObjectTypeScope());
    }

    public $type = 'project';
    protected $table = 'objects';
}
