<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BizzStatusChart extends Component
{
    public $businessesByStatus;

    /**
     * Create a new component instance.
     */
    public function __construct($businessesByStatus)
    {
        $this->businessesByStatus = $businessesByStatus;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bizz-status-chart');
    }
}
