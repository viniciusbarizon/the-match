<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Requests\JobSeeker\StoreRequest;
use App\Interfaces\JobSeekerInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController
{
    public function __construct(
        private readonly JobSeekerInterface $jobSeekerInterface,
        private readonly StoreRequest $request
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $this->jobSeekerInterface->store(
            attributes: $this->request->collect()
        );

        session()->invalidate();

        return view('job-seeker.store', [
            'slug' => $this->request->slug,
        ]);
    }
}
