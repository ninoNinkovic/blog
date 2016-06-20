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
    protected $fillable = ['user_id', 'subject_id', 'title', 'slug', 'sub_title', 'summary', 'details', 'display'];

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
     * Default values for attributes
     * @var  array an array with attribute as key and default as value
     */
    /*protected $attributes = [
        'slug' => '',
    ];*/

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    /*protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $model->generateSlug();
        });

        static::deleting(function ($article) {
            $article->detail()->delete();
            if ($article->photo)  @unlink(public_path().'/uploads/demo/'.$article->photo);
        });
    }*/

    /**
     * Generates a URL friendly "slug" from the title
     *
     * @return bool returns true if successful. false on failure.
     */
    /*protected function generateSlug()
    {
        $this->attributes['slug'] = str_slug($this->title, '-');
        if (empty($this->attributes['slug'])) {
            return false;
        }
        return true;
    }*/

    /**
     * Get the user that related with the article.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the subject that related with the article.
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
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
