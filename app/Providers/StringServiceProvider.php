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
            $rows = $this->explode(PHP_EOL);

            $result = $rows
                ->take($limit)
                ->when($rows > $limit, fn (Collection $items) => $items->push('...'))
                ->implode(PHP_EOL);

            return new Stringable($result);
        });
    }
}
