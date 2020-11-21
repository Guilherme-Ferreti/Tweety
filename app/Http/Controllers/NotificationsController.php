<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications(request('filter'));

        foreach ( $notifications as $notification ) {

            if ($notification->seen_at === null) $notification->markAsSeen();
        }

        return view('notifications', [
            'notifications' => $notifications
        ]);
    }
}
