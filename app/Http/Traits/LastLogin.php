<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait LastLogin
{
    public function updateLastLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_login = now();
            $user->save();
        }
    }
}
