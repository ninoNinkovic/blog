<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'display',
    ];

    /**
     * The videos that belong to the gallery.
     */
    public function videos()
    {
        return $this->belongsToMany('App\Models\Video');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Get all of the tags for the gallery.
     */
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    /**
     * Get all of the gallery's likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }
}
