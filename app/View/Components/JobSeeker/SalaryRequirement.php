<?php

namespace App\View\Components\JobSeeker;

use App\Models\Contract;
use App\Models\Currency;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SalaryRequirement extends Component
{
    const CURRENCY_REAL_ID = '01H0K88685BR21KWWR72ARQDJK';

    public readonly array $contracts;

    public readonly array $currencies;

    public readonly string $inputContract;

    public readonly string $inputCurrency;

    public readonly string $inputSalary;

    public bool $isPerYear;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->contracts = Contract::pluck('name', 'id')->all();
        $this->currencies = Currency::pluck('name', 'id')->all();
        $this->inputContract = 'contract_id';
        $this->inputCurrency = 'currency_id';
        $this->inputSalary = 'salary';
        $this->isPerYear = Currency::find(self::CURRENCY_REAL_ID)->is_salary_per_year;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job-seeker.salary-requirement');
    }
}
