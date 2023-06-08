<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logo extends Component
{
    public string $alt;

    public string $id;

    public string $path;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->alt = config('app.name');
        $this->id = 'logo';
        $this->path = 'resources/images/logo.png';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.logo');
    }
}
