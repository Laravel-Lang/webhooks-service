<?php

declare(strict_types=1);

namespace App\Jobs\GitHub;

use App\Jobs\Job;
use GrahamCampbell\GitHub\Facades\GitHub as Graham;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DependabotJob extends Job implements ShouldBeUnique
{
    protected string $message = '@dependabot merge';

    public int $uniqueFor = 600;

    public function __construct(
        public string $organization,
        public string $repository,
        public int $pullRequestId
    ) {}

    public function handle(): void
    {
        Graham::issues()->comments()->create(
            $this->organization,
            $this->repository,
            $this->pullRequestId,
            $this->body()
        );
    }

    public function uniqueId(): string
    {
        return implode(':', [
            $this->organization,
            $this->repository,
            $this->pullRequestId,
        ]);
    }

    protected function body(): array
    {
        return ['body' => $this->message];
    }
}
