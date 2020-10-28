<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\JWTGuard;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    // user has many posts
    public function posts()
    {
        return $this->hasMany('App\Models\Posts', 'author_id');
    }

    // user has many comments
    public function comments()
    {
        return $this->hasMany('App\Models\Comments', 'from_user');
    }

    public function can_post()
    {
        $role = $this->role;
        if ($role == 'author' || $role == 'admin') {
            return true;
        }
        else {
            return false;
        }
    }

    public function is_admin()
    {
        $role = $this->role;
        if ($role == 'admin') {
            return true;
        }
        else {
            return false;
        }
    }

//    public function GetJWTIdentifier(){
//        return $this->getKey();
//    }
//
//    public function GetJWTCustomClaims(){
//        return [];
//    }



}
