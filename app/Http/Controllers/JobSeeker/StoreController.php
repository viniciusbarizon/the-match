<?php

namespace App\Http\Controllers\JobSeeker;

use App\Actions\JobSeeker\StoreAction;
use App\Http\Requests\JobSeeker\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): View
    {
        (new StoreAction(
            attributes: $request->collect()
        ))->store();

        return view('job-seeker.store', [
            'slug' => $request->slug,
        ]);
    }
}
