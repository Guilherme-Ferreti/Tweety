<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tweet;
use App\Models\Notification;

class TweetsLikesController extends Controller
{
    public function store(Tweet $tweet)
    {   
        $tweet->like(current_user());

        if ( auth()->user()->id != $tweet->user_id ) {

            Notification::create([
                'user_id' => $tweet->user_id,
                'message' => 'Hurray! ' . current_user()->username . ' liked one of your tweets!'
            ]);
            
        }

        return back();
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->dislike(current_user());
        
        return back();
    }
}
