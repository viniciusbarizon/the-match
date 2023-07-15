<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        return view('job-seeker.create');
    }
}
