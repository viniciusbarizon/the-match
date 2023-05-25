<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    public string $title;

    public function __construct()
    {
        $this->title = config('app.name').' - '.
            _('Dê o match da sua pretensão salarial antes de iniciar o processo seletivo');
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
