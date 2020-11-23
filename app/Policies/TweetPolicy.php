<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Models\Tweet;

class TweetPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Tweet $tweet)
    {

        return $user->id == $tweet->user_id;
    }
}
