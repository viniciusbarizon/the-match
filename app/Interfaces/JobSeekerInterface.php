<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface JobSeekerInterface
{
    public function store(Collection $attributes): string;
}
