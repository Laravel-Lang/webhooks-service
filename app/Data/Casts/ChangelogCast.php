<?php

namespace App\Data\Casts;

use Illuminate\Support\Str;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ChangelogCast implements Cast
{
    protected string $user = '<a href="https://github.com/$1">$1</a>';

    protected string $pullRequest = '<a href="https://github.com/%s/pull/$1">#$1</a>';

    protected string $listItem = '- <code>[$1]</code>';

    protected string $fullChanges = '<a href="https://github.com/$1/$2/compare/$3">$3</a>';

    protected array $options = [
        'html_input'         => 'strip',
        'allow_unsafe_links' => false,
    ];

    protected array $tagsFrom = ['h2', '<li>'];

    protected array $tagsTo = ['b', '- '];

    protected string $allowedTags = '<h2><li><i>';

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        return Str::of($value)
            ->limit($this->limit())
            ->markdown($this->options)
            ->stripTags($this->allowedTags)
            ->replace($this->tagsFrom, $this->tagsTo)
            ->replaceMatches('/@([\w\d\-_]+)/', $this->user)
            ->replaceMatches('/#(\d+)/', $this->pull($properties))
            ->replaceMatches('/-\s+\[(.+)]/', $this->listItem)
            ->replaceMatches(
                '/https:\/\/github\.com\/([\w\d\-_]+)\/([\w\d\-_]+)\/compare\/([\d.]+)/',
                $this->fullChanges
            )
            ->toString();
    }

    protected function pull(array $properties): string
    {
        return sprintf($this->pullRequest, $properties['fullName']);
    }

    protected function limit(): int
    {
        return config('services.telegram.changelog.limit');
    }
}
