<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TeamParser
{
    public function forLocale(string $title): Collection
    {
        return Str::of($title)
            ->matchAll('/\[([\w\-,\s]+)\]:.+/')
            ->map(fn (string $match) => Str::of($match)->explode(',')->map(
                fn (string $locale) => $this->mates($locale)
            ))
            ->flatten()
            ->filter()
            ->unique()
            ->values();
    }

    protected function mates(string $locale): array
    {
        return config('github.team.' . trim($locale));
    }
}
