<?php

namespace App\Actions;

use App\Models\JobSeeker;

final class StoreAction
{
    public function __construct(
        public readonly string $contractId,
        public readonly string $currencyId,
        public readonly string $email,
        public readonly string $name,
        public readonly string $slug,
    ) { }

    public function store(): void
    {

    }

    private function create(): void
    {
        JobSeeker::create([
            'email' => $this->email,
            'name' => $this->email,
            'slug' => $this->email,
        ])
    }
}
