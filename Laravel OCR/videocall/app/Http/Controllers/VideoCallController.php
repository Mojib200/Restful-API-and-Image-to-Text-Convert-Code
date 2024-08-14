<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class VideoCallController extends Controller
{
    public function index()
    {
        return view('video-call');
    }

    public function signal(Request $request)
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ]
        );

        $pusher->trigger('video-call', 'signal', $request->all());

        return response()->json(['message' => 'Signal sent successfully']);
    }
}
