<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the users for the user type.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get all of the articles for the user type.
     */
    public function articles()
    {
        return $this->hasManyThrough('App\Models\Article', 'App\User');
    }
}
