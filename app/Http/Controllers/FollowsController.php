<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Notification;

class FollowsController extends Controller
{
    public function store( User $user )
    {
        auth()->user()->toggleFollow($user);

        if ( auth()->user()->isFollowing($user) ) {

            Notification::create([
                'user_id' => $user->id,
                'message' => 'Good News! ' . current_user()->username . ' started following you!'
            ]);
            
        } else {

            Notification::create([
                'user_id' => $user->id,
                'message' => 'Bad News! ' . current_user()->username . ' is not following you anymore :('
            ]);
            
        }

        return back();
    }

}
