<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the user that related with the article.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the subject that related with the article.
     */
    public function subject()
    {
        return $this->belongsTo('App\Model\Subject');
    }

    /**
     * Get all of the tags for the article.
     */
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    /**
     * Get the images for the article.
     */
    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    /**
     * Get the comments of the article.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Get all of the article's likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }
}
