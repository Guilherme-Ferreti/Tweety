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

    protected $fillable = ['username', 'name', 'about', 'banner', 'avatar', 'email', 'password'];

    protected $hidden = ['password', 'remember_token' ];

    protected $casts = ['email_verified_at' => 'datetime'];

    // Returns a user's timeline
    public function timeline()
    {
        $friends = $this->follows()->pluck('id'); // Ids of everyone this user is following

        return Tweet::whereIn('user_id', $friends)->orWhere('user_id', $this->id)->withLikes()->latest()->paginate(50);
    }

    public function mentions()
    {
        $mention = '@' . auth()->user()->username;

        return Tweet::where('body', 'like', '%'.$mention.'%')->withLikes()->latest()->paginate(50);
    }
    
    // Returns tweets from only 1 user  
    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getAvatarAttribute($value)
    {
        if ( $value === null ) return "https://i.pravatar.cc/200?u=" . $this->email;

        return asset('storage/' . $value);
    }

    public function getBannerAttribute($value)
    {
        if ( $value === null ) return null;
        
        return asset('storage/' . $value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function path($append = '')
    {
        $path = route('profile', $this->username);
    
        return $append ? "{$path}/$append" : $path;
    }

    public function notifications($filter = null)
    {

        switch ($filter) {
            case 'seen':
                return $this->hasMany(Notification::class)->whereNotNull('seen_at')->latest()->get();
                break;

            case 'new':
                return $this->hasMany(Notification::class)->whereNull('seen_at')->latest()->get();
                break;
            
            default:
                return $this->hasMany(Notification::class)->whereNull('seen_at')->latest()->get();
                break;
        }

        
    }

}
