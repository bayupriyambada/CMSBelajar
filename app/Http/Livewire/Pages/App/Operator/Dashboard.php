<?php

namespace App\Http\Livewire\Pages\App\Operator;

use Parsedown;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Http\Enum\RolesEnum;

class Dashboard extends Component
{
    public $mess = "aku button";

    public function monitoring()
    {
        dd($this->mess);
    }

    public function render()
    {
        $userActive = User::online()->count();
        $userNoActive = User::offline()->count();
        $allUser = User::notOperator()->count();
        $userMonitoring = User::where('roles', '!=', RolesEnum::OPERATOR)
            ->select('name', 'last_login', 'roles', 'is_online')
            ->orderByDesc('is_online')
            // ->orderByRaw('RAND()')
            ->take(10)
            ->get();
        return view('livewire.pages.app.operator.dashboard', [
            'userMonitoring' => $userMonitoring,
            'userActive' => $userActive,
            'userNoActive' => $userNoActive,
            'allUser' => $allUser,
        ]);
    }
}
