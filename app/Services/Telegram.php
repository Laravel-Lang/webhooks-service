<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\ReleaseData;
use App\Jobs\Telegram\ReleaseJob;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Database\Eloquent\Collection;

class Telegram
{
    public function publish(ReleaseData $data): void
    {
        $this->chats()->each(
            fn (TelegraphChat $chat) => ReleaseJob::dispatch($chat->id, $data)
        );
    }

    protected function chats(): Collection
    {
        return TelegraphChat::get();
    }
}
