<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class HomeLayout extends Component
{
    public $sidebar;
    public function __construct($sidebar = false)
    {
        //
        $this->sidebar=$sidebar;
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.home');
    }
}
