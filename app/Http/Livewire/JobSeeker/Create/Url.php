<?php

namespace App\Http\Livewire\JobSeeker\Create;

use App\Models\JobSeeker;
use Illuminate\View\View;
use Livewire\Component;

class Url extends Component
{
    public string $inputName = 'name';

    public string $inputSlug = 'slug';

    public string $inputUrl = 'url';

    public int $maxlength = 255;

    public string $name;

    public string $slug;

    public string $slugFromName;

    public string $url;

    public function render(): View
    {
        return view('livewire.job-seeker.create.url');
    }

    public function mount(): void
    {
        $this->setOldValues('name');
        $this->setOldValues('slug');
        $this->setOldValues('url');
    }

    private function setOldValues($input): void
    {
        if (old($input)) {
            $this->$input = old($input);
        }
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
        $this->slug = $this->slugFromName.'-'.time();
    }

    private function setUrl(): void
    {
        if (empty($this->slug)) {
            $this->url = '';

            return;
        }

        $this->url = route('job-seekers.match', ['slug' => $this->slug]);
    }
}
