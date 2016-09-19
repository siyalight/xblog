<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed commentable_type
 * @property mixed commentable_id
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['key','value'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commentable()
    {
        return $this->morphTo();
    }
}
