<?php

namespace App\Http\Livewire\Pages;

use App\Http\Helpers\loginHelpers;
use App\Models\User;
use Livewire\Component;

class LogoutComponent extends Component
{
    public function logoutHandle()
    {
        loginHelpers::lastLogin();
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect(route('login'));
    }
    public function render()
    {
        return view('livewire.pages.logout-component');
    }
}
