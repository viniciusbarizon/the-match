<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Requests\JobSeeker\StoreRequest;
use App\Interfaces\StoreInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController
{
    public function __construct(private readonly StoreInterface $interface, private readonly StoreRequest $request)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $this->interface->store(
            attributes: $this->request->collect()
        );

        session()->invalidate();

        return view('job-seeker.store', [
            'slug' => $this->request->slug,
        ]);
    }
}
