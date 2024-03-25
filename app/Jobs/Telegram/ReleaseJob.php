<?php

declare(strict_types=1);

namespace App\Jobs\Telegram;

use App\Integrations\Boosty;
use App\Jobs\Job;
use DefStudio\Telegraph\Models\TelegraphChat;
use Throwable;

class ReleaseJob extends Job
{
    protected ?TelegraphChat $chat = null;

    public function __construct(
        public int $chatId,
        public string $organization,
        public string $repository,
        public string $version,
        public string $changelog,
        public string $url
    ) {}

    public function handle(Boosty $boosty): void
    {
        $this->sendTelegram();
        $this->sendBoosty($boosty);
        $this->resetErrors();
    }

    public function failed(?Throwable $exception): void
    {
        $this->chat()->errors <= $this->maxErrors()
            ? $this->chat()->increment('errors')
            : $this->chat()->delete();
    }

    protected function sendTelegram(): void
    {
        retry(5, fn () => $this->chat()->html($this->message())->send());
    }

    protected function sendBoosty(Boosty $boosty): void
    {
        retry(5, fn () => $boosty->publish(
            sprintf('%s %s %s released', $this->organization, $this->repository, $this->version),
            $this->changelog,
            $this->url,
            [$this->repository]
        ));
    }

    protected function message(): string
    {
        return view('message', [
            'organization' => $this->organization,
            'repository'   => $this->repository,
            'version'      => $this->version,
            'changelog'    => $this->changelog,
            'url'          => $this->url,
        ])->toHtml();
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
        return $this->chat ??= TelegraphChat::findOrFail($this->chatId);
    }
}
