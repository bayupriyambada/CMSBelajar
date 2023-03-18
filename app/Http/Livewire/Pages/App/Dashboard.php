<?php

namespace App\Http\Livewire\Pages\App;

use Livewire\Component;
use Illuminate\Support\Str;

class Dashboard extends Component
{
    public $next;
    public $queries = 'isDashboard';

    public function mount()
    {
        $this->next = request()->query($this->queries, null);
        if (!$this->next) {
            $this->next = auth()->user()->name  . '/' . Str::random(24);
            $this->redirect(route('dashboard', [$this->queries => $this->next]));
        }
    }
    public function render()
    {
        return view('livewire.pages.app.dashboard');
    }
}
