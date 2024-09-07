<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;

class BoostyStyle
{
    public static function fromHtml(string $content): array
    {
        [$text, $flags] = static::style($content);

        return [$text, 'unstyled', $flags];
    }

    protected static function style(string $content): array
    {
        $flags = [];

        while (Str::contains($content, '<')) {
            $position = Str::position($content, '<');
            $tag = Str::betweenFirst($content, '<', '>');
            $value = Str::betweenFirst($content, "<$tag>", "</$tag>");

            $length = Str::length($value);

            $content = Str::replaceFirst("<$tag>$value</$tag>", $value, $content);

            $flags[] = [0, $position, $length];
        }

        return [$content, $flags];
    }
}
