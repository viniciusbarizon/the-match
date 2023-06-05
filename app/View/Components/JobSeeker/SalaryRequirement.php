<?php

namespace App\View\Components\JobSeeker;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SalaryRequirement extends Component
{
    public string $per;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job-seeker.salary-requirement');
    }
}
