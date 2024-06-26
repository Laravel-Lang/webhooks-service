<?php

declare(strict_types=1);

namespace App\Jobs\Telegram;

use App\Enums\JobEnum;
use App\Helpers\Tags;
use App\Jobs\Job;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Str;

class ReleaseJob extends Job
{
    protected ?TelegraphChat $chat = null;

    public function __construct(
        public int $chatId,
        public string $repository,
        public string $version,
        public string $changelog,
        public string $url
    ) {
        $this->queue = JobEnum::Release->value;
    }

    public function handle(): void
    {
        $this->sendTelegram();
        $this->resetErrors();
    }

    public function failed(): void
    {
        $this->chat()->errors <= $this->maxErrors()
            ? $this->chat()->increment('errors')
            : $this->chat()->delete();
    }

    protected function sendTelegram(): void
    {
        retry(5, function () {
            ($id = $this->chat()->thread_id)
                ? $this->chat()->html($this->message())->withData('message_thread_id', $id)->send()->throw()
                : $this->chat()->html($this->message())->send()->throw();
        });
    }

    protected function message(): string
    {
        return view('message', [
            'repository' => $this->repository,
            'version'    => $this->version,
            'changelog'  => $this->changelog,
            'url'        => $this->url,
            'tags'       => $this->repositoryTags(),
        ])->toHtml();
    }

    protected function repositoryTags(): string
    {
        return collect(Tags::parse($this->repository, $this->changelog))->map(
            fn (string $tag) => Str::of($tag)
                ->replace('-', '_')
                ->prepend('#')
                ->toString()
        )->implode(' ');
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
