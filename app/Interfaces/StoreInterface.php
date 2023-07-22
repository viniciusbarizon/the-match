<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface StoreInterface
{
    public function store(Collection $attributes): string;
}
