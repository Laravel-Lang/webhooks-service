<?php

declare(strict_types=1);

namespace App\Webhooks;

use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Arr;

class Telegram extends WebhookHandler
{
    public function connect(): void
    {
        $this->welcome();

        if ($this->isForum()) {
            $this->storeThreadId();
        }

        $this->sendReply();
    }

    protected function welcome(): void
    {
        $this->chat->action(ChatActions::TYPING)->send()->throw();
    }

    protected function storeThreadId(): void
    {
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

    protected function sendReply(): void
    {
        $this->chat->html(__('Done'))->reply(
            $this->messageId
        )->send()->throw();
    }
}
