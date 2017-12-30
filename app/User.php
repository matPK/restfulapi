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
    public $transformer = UserTransformer::class;

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

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->verified = $this::UNVERIFIED_USER;
        $this->admin = $this::REGULAR_USER;
        $this->verification_token = $this::generateVerificationToken();
    }

    public function getNameAttribute($name)
    {
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

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
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

    /**
     * @return string
     */
    public function hiddenFunction()
    {
        return "this function does nothing";
    }
}
