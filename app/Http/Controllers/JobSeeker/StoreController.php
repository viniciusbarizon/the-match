<?php

namespace App\Http\Controllers\JobSeeker;

use App\Actions\JobSeeker\StoreAction;
use App\Http\Requests\JobSeeker\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class StoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request, StoreAction $storeAction): View
    {
        $storeAction->store($request->collect());

        session()->invalidate();

        return view('job-seeker.store', [
            'slug' => $request->slug,
        ]);
    }
}
