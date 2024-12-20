<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\ReleaseData;
use App\Jobs\Boosty\PublishJob;
use App\Jobs\Telegram\ReleaseJob;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Database\Eloquent\Collection;

class Release
{
    public function publish(ReleaseData $data): void
    {
        $this->publishToTelegram($data);
        $this->publishToBoosty($data);
    }

    protected function publishToTelegram(ReleaseData $data): void
    {
        $this->chats()->each(
            fn (TelegraphChat $chat) => ReleaseJob::dispatch(
                $chat->id,
                $data->repository,
                $data->version,
                $data->shortChangelog,
                $data->url
            )
        );
    }

    protected function publishToBoosty(ReleaseData $data): void
    {
        PublishJob::dispatch(
            $data->repository,
            $data->version,
            $data->changelog,
            $data->url
        );
    }

    protected function chats(): Collection
    {
        return TelegraphChat::get();
    }
}
