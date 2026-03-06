<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SiswaLayout extends Component
{
    public $hideNav;

    public function __construct($hideNav = false)
    {
        $this->hideNav = $hideNav;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.siswa');
    }
}
