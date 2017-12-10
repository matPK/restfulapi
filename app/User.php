<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int id
 * @property string name
 * @property string verified
 * @property string verification_token
 * @property string email
 * @property string password
 * @property string admin
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    public const VERIFIED_USER = '1';
    public const UNVERIFIED_USER = '0';
    public const ADMIN_USER = 'true';
    public const REGULAR_USER = 'false';

    protected $dates = ['deleted_at'];
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
        'deleted_at',
    ];

    public function getNameAttribute($name)
{
    //return ucwords($this->attributes['name']);
    return ucwords($name);
}

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = $email;
    }

    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationToken()
    {
        return str_random(40);
    }
}