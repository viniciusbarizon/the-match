<?php

namespace App\Http\Livewire\JobSeeker\CreateOrEdit;

use App\Models\JobSeeker;
use Livewire\Component;

class Url extends Component
{
    public string $inputName = 'name';

    public string $inputSlug = 'slug';

    public string $inputUrl = 'url';

    public string $name;

    public string $slug;

    public string $slugFromName;

    public string $url;

    public function render()
    {
        return view('livewire.job-seeker.create-or-edit.url');
    }

    public function updatedName(): void
    {
        $this->setSlugFromName();
        $this->setSlug();
        $this->setUrl();
    }

    public function updatedSlug(): void
    {
        $this->setUrl();
    }

    private function setSlugFromName(): void
    {
        $this->slugFromName = str()->of($this->name)->slug();
    }

    private function setSlug(): void
    {
        if ($this->isSlugAvailable()) {
            $this->slug = $this->slugFromName;
            return;
        }

        $this->setSlugWithTime();
    }

    private function isSlugAvailable(): bool
    {
        return JobSeeker::where('slug', $this->slugFromName)->doesntExist();
    }

    private function setSlugWithTime(): void
    {
        $this->slug = $this->slugFromName . '-' . time();
    }

    private function setUrl(): void
    {
        $this->url = config('app.url') . 'with/' . $this->slug;
    }
}
