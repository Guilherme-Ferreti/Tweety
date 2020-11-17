<?php

namespace App\Traits;

use App\Models\User;

trait Followable {

    // Saves a follow
    public function follow( User $user )
    {
        return $this->follows()->save($user);
    }

    // Saves a follow
    public function unfollow( User $user )
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        if ( $this->isFollowing($user) ) return $this->unfollow($user);
        
        return $this->follow($user);
    }

    public function isfollowing(User $user)
    {
        return $this->follows()->where('following_user_id', $user->id)->exists();
    }

    // Returns all of the users this user is following
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

}

?>