<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\ReleaseData;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Database\Eloquent\Collection;

class Telegram
{
    public function publish(ReleaseData $data): void
    {
        $this->chats()->each(
            fn (TelegraphChat $chat) => $this->send($chat, $data)
        );
    }

    protected function send(TelegraphChat $chat, ReleaseData $data): void
    {
        rescue(fn () => $chat->html($this->message($data))->send());
    }

    protected function message(ReleaseData $release): string
    {
        return view('message', compact('release'))->toHtml();
    }

    protected function chats(): Collection
    {
        return TelegraphChat::get();
    }
}
