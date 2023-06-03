<?php

namespace App\View\Components;

use Closure;
use App\Models\Contract as ContractModel;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Contract extends Component
{
    public readonly array $contracts;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->contracts = ContractModel::pluck('name', 'id')->all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contract');
    }
}
