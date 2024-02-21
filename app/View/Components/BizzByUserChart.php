<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BizzByUserChart extends Component
{
    public $bizzByUser;

    public function __construct($bizzByUser)
    {
        $this->bizzByUser = $bizzByUser;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bizz-by-user-chart');
    }
}
