<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NavigationMenu extends Component
{
    public $currentRoute;

    public function mount()
    {
        $this->currentRoute = request()->route()->getName();
    }

    public function logout()
    {
        Auth::logout();
        return $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.navigation-menu');
    }
}
