<?php

namespace App\Data\Casts;

use Illuminate\Support\Str;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ChangelogCast implements Cast
{
    protected string $listItem = '- <code>[$1]</code>';

    protected string $from = '/\sby\s@[\w\d\-]+\sin\s#\d+/';

    protected string $fullLink = '/\*{0,2}Full\sChangelog\*{0,2}:\s.+\/compare\/[\d\.]+/';

    protected array $options = [
        'html_input' => 'strip',
        'allow_unsafe_links' => false,
    ];

    protected array $tagsFrom = ['h2', '<li>', '</li>'];

    protected array $tagsTo = ['b', '- ', ''];

    protected array $allowedTags = ['h2', 'li', 'i'];

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        return Str::of($value)
            ->replaceMatches([$this->from, $this->fullLink], '')
            ->trim()
            ->limitRows($this->limit())
            ->markdown($this->options)
            ->stripTags($this->allowedTags)
            ->replace($this->tagsFrom, $this->tagsTo)
            ->replaceMatches('/-\s+\[(.+)]/', $this->listItem)
            ->replace('\n\n\n', '\n\n')
            ->toString();
    }

    protected function limit(): int
    {
        return config('services.telegram.changelog.limit');
    }
}
