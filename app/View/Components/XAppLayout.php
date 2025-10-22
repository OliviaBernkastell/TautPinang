<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class XAppLayout extends Component
{
    public function render(): View
    {
        return view('layouts.x-app-layout');
    }
}