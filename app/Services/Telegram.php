<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\ReleaseData;
use Illuminate\Support\Facades\Http;

class Telegram
{
    public function __construct(
        protected string $token,
        protected array $chatIds
    ) {
    }

    public function publish(ReleaseData $data): void
    {
        foreach ($this->chatIds as $chatId) {
            $this->send((int)$chatId, $this->message($data));
        }
    }

    protected function send(int $chatId, string $content): void
    {
        Http::acceptJson()->post($this->url('sendMessage'), [
            'chat_id' => $chatId,
            'text' => $content,
            'parse_mode' => 'HTML',
        ]);
    }

    protected function message(ReleaseData $release): string
    {
        return view('message', compact('release'))->toHtml();
    }

    protected function url(string $method): string
    {
        return sprintf('https://api.telegram.org/bot%s/%s', $this->token, $method);
    }
}
