<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddedBizzPercentage extends Component
{
    public $addedBizzChart;
    public $addedPercentage;

    public function __construct($addedBizzChart, $addedPercentage)
    {
        $this->addedBizzChart = $addedBizzChart;
        $this->addedPercentage = $addedPercentage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.added-bizz-percentage');
    }
}
