<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RevenueChartCard extends Component
{
    public $revenue;
    public $years;
    public $total;

    public function __construct($revenue, $years, $total)
    {
        $this->revenue = $revenue;
        $this->years = $years;
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.revenue-chart-card');
    }
}
