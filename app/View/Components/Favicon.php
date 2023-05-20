<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Favicon extends Component
{
    public string $path;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->path = 'resources/images/favicon.ico';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.favicon');
    }
}
