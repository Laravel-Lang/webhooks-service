<?php

declare(strict_types=1);

namespace App\Jobs\Boosty;

use App\Enums\JobEnum;
use App\Helpers\Tags;
use App\Integrations\Boosty;
use App\Jobs\Job;
use Illuminate\Support\Str;

class PublishJob extends Job
{
    public function __construct(
        public string $repository,
        public string $version,
        public string $changelog,
        public string $url
    ) {
        $this->queue = JobEnum::Release->value;
    }

    public function handle(Boosty $boosty): void
    {
        $boosty->publish(
            sprintf('%s %s released', $this->repository, $this->version),
            $this->resolveChangelog($this->changelog),
            $this->url,
            $this->repositoryTags()
        );
    }

    protected function repositoryTags(): array
    {
        return Tags::parse($this->repository, $this->changelog);
    }

    protected function resolveChangelog(string $content): string
    {
        return Str::replace(['<blockquote expandable>', '</blockquote>'], '', $content);
    }
}
