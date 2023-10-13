<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{

    public $isAuth;

    /**
     * Create a new component instance.
     */
    public function __construct($isAuth)
    {
        $this -> isAuth = $isAuth;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}