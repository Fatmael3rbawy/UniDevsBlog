<?php

namespace Modules\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password','avatar',
    ];

    protected static function boot()
    {
        parent::boot();

        static::Deleted(function ($row) {
            if ($row->avatar)
                Storage::delete('/public/'.$row->avatar);

        });
       
    }

    public function setAvatarAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['avatar']))
                Storage::delete('/public/'.$this->attributes['avatar']);
            $img = time() . md5(uniqid()) . "." . $value->guessExtension();
            $path = $value->storeAs('users', $img, 'public');
            $this->attributes['avatar'] = $path;
        }
    }



   /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


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
}
