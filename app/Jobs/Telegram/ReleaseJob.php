<?php

declare(strict_types=1);

namespace App\Jobs\Telegram;

use App\Data\ReleaseData;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ReleaseJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected ?TelegraphChat $chat = null;

    public function __construct(
        public int $chatId,
        public ReleaseData $data
    ) {}

    public function handle(): void
    {
        $this->send();
        $this->resetErrors();
    }

    public function failed(?Throwable $exception): void
    {
        $this->chat()->errors <= $this->maxErrors()
            ? $this->chat()->increment('errors')
            : $this->chat()->delete();
    }

    protected function send(): void
    {
        retry(5, fn () => $this->chat()->html($this->message())->send());
    }

    protected function message(): string
    {
        return view('message', ['release' => $this->data])->toHtml();
    }

    protected function resetErrors(): void
    {
        $this->chat()->updateQuietly(['errors' => 0]);
    }

    protected function maxErrors(): int
    {
        return config('services.telegram.max_errors');
    }

    protected function chat(): TelegraphChat
    {
        return $this->chat ??= TelegraphChat::where('chat_id', $this->chatId)->firstOrFail();
    }
}
