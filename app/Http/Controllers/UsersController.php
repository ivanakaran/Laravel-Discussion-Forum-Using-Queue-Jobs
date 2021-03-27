<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{
    public function notifications()
    {

        //mark all as read
        auth()->user()->unreadNotifications->markAsRead();

        //display notifications

        return view('users.notifications', ['notifications' => auth()->user()->notifications]);
    }
}