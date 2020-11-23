<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Models\Notification;

class NotificationPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Notification $notification)
    {

        return $user->id == $notification->user_id;
        
    }
}
