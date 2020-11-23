<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Notification;

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

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->back();
    }

    public function destroyAll()
    {

        Notification::where('user_id', '=', auth()->user()->id)->get()
            ->map(function ($notification) {
                return $notification->delete();
            });

        return redirect()->back();
    }
}
