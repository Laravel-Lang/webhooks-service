<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\ReleaseData;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Database\Eloquent\Collection;

class Telegram
{
    protected int $maxErrors = 10;

    public function publish(ReleaseData $data): void
    {
        $this->chats()->each(
            fn (TelegraphChat $chat) => rescue(
                fn () => $this->send($chat, $data),
                fn () => $this->failed($chat)
            )
        );
    }

    protected function send(TelegraphChat $chat, ReleaseData $data): void
    {
        $chat->html($this->message($data))->send();

        $this->resetErrors($chat);
    }

    protected function failed(TelegraphChat $chat): void
    {
        $chat->errors <= $this->maxErrors
            ? $chat->increment('errors')
            : $chat->delete();
    }

    protected function message(ReleaseData $release): string
    {
        return view('message', compact('release'))->toHtml();
    }

    protected function chats(): Collection
    {
        return TelegraphChat::get();
    }

    protected function resetErrors(TelegraphChat $chat): void
    {
        $chat->updateQuietly(['errors' => 0]);
    }
}
