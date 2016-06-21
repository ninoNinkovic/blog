<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
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

        static::creating(function($subject)
        {
            $subject->slug = utf8_slug($subject->name);
            $subject->created_by = Auth::user()->id;
        });

        static::updating(function ($subject)
        {
            $subject->slug = utf8_slug($subject->name);
        });

        static::deleting(function($subject)
        {
            $subject->deleted_by = Auth::user()->id;
            $subject->save();
        });

        static::restoring(function($subject)
        {
            $subject->deleted_by = null;
            $subject->save();
        });
    }

    /**
     * Get the user who create the subject.
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the user who delete the subject.
     */
    public function remover()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }

    /**
     * Get the articles for the subject.
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
}
