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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function($gallery)
        {
            $gallery->slug = utf8_slug($gallery->name);
            $gallery->created_by = Auth::user()->id;
        });

        static::updating(function ($gallery)
        {
            $gallery->slug = utf8_slug($gallery->name);
        });

        static::deleting(function($gallery)
        {
            $gallery->deleted_by = Auth::user()->id;
            $gallery->save();
        });

        static::restoring(function($gallery)
        {
            $gallery->deleted_by = null;
            $gallery->save();
        });
    }

    /**
     * Get the user who create the gallery.
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the user who delete the gallery.
     */
    public function remover()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }
    
    /**
     * The videos that belong to the gallery.
     */
    public function videos()
    {
        return $this->belongsToMany('App\Models\Video');
    }
    
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
