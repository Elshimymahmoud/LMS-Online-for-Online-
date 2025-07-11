<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead(Request $request, $id)
    {
        $notification = Auth::user()->notifications()->find($id);
        if($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }
}