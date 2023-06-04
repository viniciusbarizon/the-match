<?php

namespace App\View\Components;

use App\Models\Currency as CurrencyModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Currency extends Component
{
    public readonly array $currencies;

    public string $input;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->currencies = CurrencyModel::pluck('name', 'id')->all();
        $this->input = 'currency_id';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.currency');
    }
}
