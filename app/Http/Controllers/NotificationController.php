<?php

namespace App\Http\Controllers;

use App\Notification;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show()
    {
        if(Auth::user()->roles[0]->name != 'Driver') {
            $notifications = Notification::with('dailysale_notif.user', 'user', 'driver')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            $count = Notification::with('dailysale_notif')->where('status', 0)->count();
        } else {
            $notifications = Notification::with('dailysale_notif.user', 'user', 'driver')->where('driver_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            $count = Notification::with('dailysale_notif')->where('driver_id', Auth::user()->id)->where('status', 0)->count();
        }

        return response()->json(compact('notifications', 'count'));
    }
}
