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
    public function __invoke(StoreRequest $request): View
    {
        $this->store(
            attributes: $request->collect()
        );

        session()->invalidate();

        return view('job-seeker.store', [
            'slug' => $request->slug,
        ]);
    }

    private function store(Collection $attributes): void
    {
        (new StoreAction(attributes: $attributes))
            ->store();
    }
}
