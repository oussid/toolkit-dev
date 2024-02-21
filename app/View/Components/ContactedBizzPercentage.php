<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactedBizzPercentage extends Component
{
    public $contactedBizzChart;
    public $contactedPercentage;

    public function __construct($contactedBizzChart, $contactedPercentage)
    {
        $this->contactedBizzChart = $contactedBizzChart;
        $this->contactedPercentage = $contactedPercentage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contacted-bizz-percentage');
    }
}
