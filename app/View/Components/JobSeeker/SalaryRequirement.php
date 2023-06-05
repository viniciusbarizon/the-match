<?php

namespace App\View\Components\JobSeeker;

use App\Models\Currency;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SalaryRequirement extends Component
{
    public boolean $isPerYear;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->isPerYear = Currency::find('01H0K88685BR21KWWR72ARQDJK')->is_salary_per_year;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job-seeker.salary-requirement');
    }
}
