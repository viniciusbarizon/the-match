<?php

namespace App\View\Components\JobSeeker;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Store extends Component
{
    public readonly string $url;

    /**
     * Create a new component instance.
     */
    public function __construct(public readonly string $slug)
    {
        $this->url = route('job-seekers.match', ['slug' => $slug]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job-seeker.store');
    }
}
