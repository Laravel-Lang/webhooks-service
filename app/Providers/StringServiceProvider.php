<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Stringable;

class StringServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Stringable::macro('limitRows', function (int $limit) {
            $result = $this
                ->explode(PHP_EOL)
                ->take($limit)
                ->when(
                    fn (Collection $items) => $limit < $items->count(),
                    fn (Collection $items) => $items->push('...')
                )->implode(PHP_EOL);

            return new Stringable($result);
        });
    }
}
