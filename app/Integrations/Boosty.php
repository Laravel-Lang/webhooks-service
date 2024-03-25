<?php

declare(strict_types=1);

namespace App\Integrations;

use Illuminate\Support\Facades\Http;

readonly class Boosty
{
    public function __construct(
        protected string $token,
        protected string $blog,
    ) {}

    public function publish(string $title, string $body, string $url, array $tags): void
    {
        Http::acceptJson()->asForm()
            ->withHeader('Authorization', 'Bearer ' . $this->token)
            ->post($this->url(), [
                'title' => $title,
                'data'  => json_encode([
                    $this->textBlock($body),
                    $this->endBlock(),
                    $this->urlBlock($url),
                    $this->endBlock(),
                ]),
                'price'           => 0,
                'teaser_data'     => [],
                'tags'            => implode(',', $tags),
                'has_chat'        => false,
                'advertiser_info' => '',
            ])->throw();
    }

    protected function textBlock(string $text): array
    {
        return [
            'type'        => 'text',
            'content'     => json_encode([$text, 'unstyled', []]),
            'modificator' => '',
        ];
    }

    protected function urlBlock(string $url): array
    {
        return [
            'type'    => 'link',
            'content' => json_encode([$url, 'unstyled', []]),
            'url'     => $url,
        ];
    }

    protected function endBlock(): array
    {
        return [
            'type'        => 'text',
            'content'     => json_encode(''),
            'modificator' => 'BLOCK_END',
        ];
    }

    protected function url(): string
    {
        return sprintf('https://api.boosty.to/v1/blog/%s/post/', $this->blog);
    }
}
