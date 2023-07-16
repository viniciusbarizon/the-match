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
            contractId: $request->contract_id,
            currencyId: $request->currency_id,
            email: $request->email,
            name: $request->name,
            salary: $request->salary,
            slug: $request->slug,
        ))->store();

        return view('job-seeker.store', [
            'slug' => $request->slug,
        ]);
    }
}
