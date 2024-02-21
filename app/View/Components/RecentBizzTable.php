<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecentBizzTable extends Component
{
    public $businesses;

    public function __construct($businesses)
    {
        $this->businesses = $businesses;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recent-bizz-table');
    }
}
