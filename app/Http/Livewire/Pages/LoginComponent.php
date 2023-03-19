<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Http\Helpers\loginHelpers;
use Illuminate\Support\Facades\Auth;

class LoginComponent extends Component
{
    public $app = "Masuk CMS Belajar";
    public $email;
    public $password;

    public $next;

    public function mount()
    {
        $this->next = request()->query('urlLoginCms', null);
        if (!$this->next) {
            $this->next = now() . '_' . Str::random(24);
            $this->redirect(route('login', ['urlLoginCms' => $this->next]));
        }
    }

    public function loginHandle()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            //berhasil login
            loginHelpers::onLogin();
            return redirect(route('dashboard'));
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => "Berhasil login dengan akun anda."]
            );
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "Alamat Email atau Password Anda salah!."]
            );
            return redirect(route('login'));
        }
    }
    public function render()
    {
        return view('livewire.pages.login-component')->layout('layouts.auth');
    }
}
