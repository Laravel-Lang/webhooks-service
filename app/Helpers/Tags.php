<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class Tags
{
    public static function parse(string $value, int $max = 10): array
    {
        return static::prepare($value)
            ->explode('-')
            ->sort()
            ->prepend(static::prepare($value, '_'))
            ->take($max)
            ->all();
    }

    protected static function prepare(string $value, string $delimiter = '-'): Stringable
    {
        return Str::of($value)
            ->trim()
            ->squish()
            ->lower()
            ->replace(['_', '-', ' '], $delimiter);
    }
}
