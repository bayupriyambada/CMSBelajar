<?php

namespace App\Http\Livewire\Pages\App\Operator;

use App\Http\Enum\RolesEnum;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $mess = "aku button";

    public function monitoring()
    {
        dd($this->mess);
    }

    public function render()
    {
        $userMonitoring = User::where('roles', '!=', RolesEnum::OPERATOR)
            ->select('name', 'last_login', 'roles')
            ->orderBy('last_login', 'desc')
            ->limit(10)
            ->get();
        return view('livewire.pages.app.operator.dashboard', [
            'userMonitoring' => $userMonitoring
        ]);
    }
}
