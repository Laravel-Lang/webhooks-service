<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class Tags
{
    public static function parse(string $repository, string $changelog, int $max = 10): array
    {
        return array_merge(
            static::repository($repository, $max),
            static::changelog($changelog)
        );
    }

    protected static function repository(string $value, int $max): array
    {
        return static::prepare($value)
            ->explode('-')
            ->sort()
            ->prepend(static::prepare($value, '_'))
            ->unique()
            ->take($max)
            ->all();
    }

    protected static function changelog(string $changelog): array
    {
        return Str::of($changelog)
            ->matchAll('/<b>(.+)<\/b>/')
            ->map(fn (string $title) => Str::of($title)->squish()->snake()->trim()->toString())
            ->reject(fn (string $tag) => Str::contains($tag, 'contributor'))
            ->sort()
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
