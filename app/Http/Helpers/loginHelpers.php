<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Auth;

class loginHelpers
{
    public static function onLogin()
    {
        $user = Auth::user();
        $user->last_login = null;
        $user->save();
    }
    public static function lastLogin()
    {
        $user = Auth::user();
        $user->last_login = now();
        $user->save();
    }
}
