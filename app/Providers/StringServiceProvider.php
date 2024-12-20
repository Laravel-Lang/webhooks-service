<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class StringServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Stringable::macro('short', function (int $limit, string $end = '...and more...'): Stringable {
            if ($this->length() <= $limit) {
                return $this;
            }

            $value = $this->value();

            while ($limit < Str::length($value)) {
                $lines = Str::of($value)->explode("\n");

                $lines->pop();

                $value = $lines->implode("\n");
            }

            return new Stringable($value . "\n" . $end);
        });
    }
}
