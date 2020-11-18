<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Traits\Followable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'name', 'avatar', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Returns a user's timeline
    public function timeline()
    {
        $friends = $this->follows()->pluck('id'); // Ids of everyone this user is following

        return Tweet::whereIn('user_id', $friends)->orWhere('user_id', $this->id)->latest()->get();
    }
    
    // Returns tweets from only 1 user  
    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    public function getAvatarAttribute($value)
    {
        if ( $value === null ) return "https://i.pravatar.cc/200?u=" . $this->email;

        return asset('storage/' . $value);
    }

    public function path($append = '')
    {
        $path = route('profile', $this->username);
    
        return $append ? "{$path}/$append" : $path;
    }

}
