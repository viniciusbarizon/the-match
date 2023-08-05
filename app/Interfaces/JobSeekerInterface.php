<?php

namespace App\Interfaces;

use App\Models\JobSeeker;
use Illuminate\Support\Collection;

interface JobSeekerInterface
{
    public function store(Collection $attributes): JobSeeker;
}
