<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class StringServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Stringable::macro('limitRows', function (int $limit) {
            $rows = $this->explode("\n");

            $need = $limit;

            $lines = 0;

            $rows->each(function (string $value) use (&$lines, &$need) {
                if (Str::of($value)->trim()->startsWith('-')) {
                    --$need;
                }

                if ($need > 0) {
                    ++$lines;
                }
            });

            $result = $rows->take($lines)->when($need < 0, function (Collection $items) use ($need) {
                $count = abs($need);

                $pluralized = $count === 1 ? 'change' : 'changes';

                $items->push("\n(and $count more $pluralized)");
            })->implode(PHP_EOL);

            return new Stringable($result);
        });
    }
}
