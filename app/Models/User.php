<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type_id',
    ];

    /**
     * Default values for attributes
     *
     * @var  array an array with attribute as key and default as value
     */
    protected $attributes = [
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Set the password to be hashed when saved
     *
     * @param  string $password
     *
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Check the administrative privilege of the user.
     */
    public function isAdministrator()
    {
        return $this->user_type_id === 1 ? true : false;
    }

    /**
     * Get the profile record associated with the user.
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    /**
     * Get the type of the user.
     */
    public function user_type()
    {
        return $this->belongsTo('App\Models\UserType');
    }

    /**
     * Get the articles of the user.
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
}
