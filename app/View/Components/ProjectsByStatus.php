<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectsByStatus extends Component
{
    public $projectsByStatus;

    public function __construct($projectsByStatus)
    {
        $this->projectsByStatus = $projectsByStatus;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.projects-by-status');
    }
}
