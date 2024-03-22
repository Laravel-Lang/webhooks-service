<?php

namespace App\Data\Casts;

use Illuminate\Support\Str;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ChangelogCast implements Cast
{
    protected string $user = '<a href="https://github.com/$1">$1</a>';

    protected string $pullRequest = '<a href="https://github.com/%s/%s/pull/$1">#$1</a>';

    protected string $listItem = '- <code>[$1]</code>';

    protected array $options = [
        'html_input'         => 'strip',
        'allow_unsafe_links' => false,
    ];

    protected array $tagsFrom = ['h2', '<ul>', '</ul>', '<li>', '</li>'];

    protected array $tagsTo = ['b', '', '', '- ', ''];

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        return Str::of($value)
            ->limit($this->limit())
            ->markdown($this->options)
            ->replace($this->tagsFrom, $this->tagsTo)
            ->replaceMatches('/@([\w\d\-_]+)/', $this->user)
            ->replaceMatches('/#(\d+)/', $this->pull($properties))
            ->replaceMatches('/-\s+\[(.+)]/', $this->listItem)
            ->toString();
    }

    protected function pull(array $properties): string
    {
        return sprintf($this->pullRequest, $properties['organization'], $properties['repository']);
    }

    protected function limit(): int
    {
        return config('services.telegram.changelog.limit');
    }
}
