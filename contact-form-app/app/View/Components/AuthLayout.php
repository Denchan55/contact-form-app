<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    public function __construct(
        public bool $showRegister = false,
        public bool $showLogin = false
    ) {}

    public function render()
    {
        return view('layouts.auth');
    }
}
