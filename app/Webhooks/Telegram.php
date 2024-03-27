<?php

declare(strict_types=1);

namespace App\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Arr;

class Telegram extends WebhookHandler
{
    public function connect(): void
    {
        if (! $this->isForum()) {
            return;
        }

        if ($id = $this->threadId()) {
            $this->chat->thread_id = $id;
            $this->chat->save();
        }
    }

    protected function threadId(): ?int
    {
        return Arr::get($this->request->get('message', []), 'message_thread_id');
    }

    protected function isForum(): bool
    {
        return (bool) Arr::get($this->request->get('message', []), 'chat.is_forum', false);
    }
}
