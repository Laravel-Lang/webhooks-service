<?php

declare(strict_types=1);

namespace App\Integrations;

use App\Helpers\BoostyStyle;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

readonly class Boosty
{
    protected PendingRequest $client;

    public function __construct(
        protected string $token,
        protected string $blog,
    ) {
        $this->client = Http::acceptJson()->asForm()->withHeader(
            'Authorization',
            'Bearer ' . $this->token
        );
    }

    public function publish(string $title, string $body, string $url, array $tags): void
    {
        $this->client->post($this->url(), [
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
        return $this->block(BoostyStyle::fromHtml($text));
    }

    protected function urlBlock(string $url): array
    {
        return $this->block(
            content: [PHP_EOL . $url, 'unstyled', []],
            type: 'link',
            modificator: $url,
            modKey: 'url'
        );
    }

    protected function endBlock(): array
    {
        return $this->block('', modificator: 'BLOCK_END');
    }

    protected function block(
        array|string $content,
        string $type = 'text',
        string $modificator = '',
        string $modKey = 'modificator'
    ): array {
        return [
            'type'    => $type,
            'content' => json_encode($content),
            $modKey   => $modificator,
        ];
    }

    protected function url(): string
    {
        return sprintf('https://api.boosty.to/v1/blog/%s/post/', $this->blog);
    }
}
