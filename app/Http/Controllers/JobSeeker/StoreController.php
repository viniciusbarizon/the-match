<?php

namespace App\Http\Controllers\JobSeeker;

use App\Actions\JobSeeker\StoreAction;
use App\Http\Requests\JobSeeker\StoreRequest;
use App\Interfaces\StoreInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreAction $storeAction, StoreInterface $storeInterface, StoreRequest $request): View
    {
        //$storeInterface->store($storeAction);
        $storeAction->store(
            attributes: $request->collect()
        );

        session()->invalidate();

        return view('job-seeker.store', [
            'slug' => $request->slug,
        ]);
    }
}
