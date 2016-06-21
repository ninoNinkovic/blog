<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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

        static::creating(function($tag)
        {
            $tag->slug = utf8_slug($tag->name);
            $tag->created_by = Auth::user()->id;
        });

        static::updating(function ($tag)
        {
            $tag->slug = utf8_slug($tag->name);
        });

        static::deleting(function($tag)
        {
            $tag->deleted_by = Auth::user()->id;
            $tag->save();
        });

        static::restoring(function($tag)
        {
            $tag->deleted_by = null;
            $tag->save();
        });
    }

    /**
     * Get the user who create the tag.
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the user who delete the tag.
     */
    public function remover()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }

    /**
     * Get all of the articles that are assigned this tag.
     */
    public function articles()
    {
        return $this->morphedByMany('App\Models\Article', 'taggable');
    }

    /**
     * Get all of the galleries that are assigned this tag.
     */
    public function galleries()
    {
        return $this->morphedByMany('App\Models\Article', 'taggable');
    }
}