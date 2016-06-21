<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
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
     * Boot function for using with User Events
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function($video)
        {
            $video->slug = utf8_slug($video->name);
            $video->created_by = Auth::user()->id;
        });

        static::updating(function ($video)
        {
            $video->slug = utf8_slug($video->name);
        });

        static::deleting(function($video)
        {
            $video->deleted_by = Auth::user()->id;
            $video->save();
        });

        static::restoring(function($video)
        {
            $video->deleted_by = null;
            $video->save();
        });
    }

    /**
     * Get the user who create the video.
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the user who delete the video.
     */
    public function remover()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }
    
    /**
     * The galleries that belong to the video.
     */
    public function galleries()
    {
        return $this->belongsToMany('App\Models\Gallery');
    }
}
