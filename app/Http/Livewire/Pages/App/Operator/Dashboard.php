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
            ->select('name', 'last_login', 'roles', 'is_online')
            // ->orderBy('last_login', 'asc')
            ->orderByRaw('RAND()')
            ->take(10)
            ->get();
        return view('livewire.pages.app.operator.dashboard', [
            'userMonitoring' => $userMonitoring
        ]);
    }
}
