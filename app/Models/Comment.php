<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visitor_id', 'title', 'details', 'display',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Get the visitor of the comment.
     */
    public function visitor()
    {
        return $this->belongsTo('App\Model\Visitor');
    }

    /**
     * Get the article that related with this comment.
     */
    public function article()
    {
        return $this->belongsTo('App\Model\Article');
    }

    /**
     * Get all of the article's likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }
}
