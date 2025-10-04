<?php

declare(strict_types=1);

namespace App\Data\Casts;

use Illuminate\Support\Str;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use SteppingHat\EmojiDetector\EmojiDetector;
use SteppingHat\EmojiDetector\Model\EmojiInfo;

class ChangelogCast implements Cast
{
    protected string $listItem = '- <code>[$1]</code>';

    protected string $from = '/\sby\s@[\w\d\-]+\s+in\s+#?.+/';

    protected string $fullLink = '/\*{0,2}Full\sChangelog\*{0,2}:\s.+\/compare\/[\d\.]+/';

    protected string $contributors = '/\*\s+(@[\w\d\-_]+)\smade\stheir\sfirst\scontribution.*/';

    protected string $contributor = '- $1';

    protected array $options = [
        'html_input'         => 'strip',
        'allow_unsafe_links' => false,
    ];

    protected array $tagsFrom = ['h2', '<li>', '</li>', '<ul>', '</ul>'];

    protected array $tagsTo = ['b', '- ', '', '<blockquote expandable>', '</blockquote>'];

    protected array $allowedTags = ['h2', 'li', 'i', 'em', 'ul'];

    protected string $resolveSpaces = '/<li>\n?\s*(.+)\n?\s*<\/li>/';

    public function __construct(
        protected bool $short = false
    ) {}

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        return Str::of($this->removeEmojis($value))
            ->replaceMatches([$this->from, $this->fullLink], '')
            ->replaceMatches($this->contributors, $this->contributor)
            ->trim()
            ->short(2000)
            ->markdown($this->options)
            ->replaceMatches($this->resolveSpaces, '<li>$1</li>')
            ->stripTags($this->allowedTags)
            ->replace($this->tagsFrom, $this->tagsTo)
            ->replaceMatches('/-\s+\[(.+)]/', $this->listItem)
            ->replace("\n\n\n", "\n\n")
            ->toString();
    }

    protected function removeEmojis(string $value): string
    {
        if ($emojis = $this->emojis($value)) {
            return Str::replace($emojis, '', $value);
        }

        return $value;
    }

    protected function emojis(string $value): array
    {
        return collect($this->emoji()->detect($value))->map(
            fn (EmojiInfo $item) => $item->getEmoji()
        )->all();
    }

    protected function emoji(): EmojiDetector
    {
        return new EmojiDetector;
    }
}
