<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Requests\JobSeeker\StoreRequest;
use App\Mail\JobSeeker\Stored;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class StoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): View
    {
        session()->invalidate();

        Mail::to($request->email)->send(
            new Stored($request->name, $request->slug)
        );

        return view('job-seeker.store', [
            'slug' => $request->slug,
        ]);
    }
}
