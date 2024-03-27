<?php

declare(strict_types=1);

namespace App\Jobs\GitHub;

use App\Data\PullRequestData;
use App\Jobs\Job;
use App\Services\PullRequest;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DependabotJob extends Job implements ShouldBeUnique
{
    protected string $message = '@dependabot rebase';

    public int $uniqueFor = 600;

    public function __construct(
        public PullRequestData $data
    ) {}

    public function handle(PullRequest $pullRequest): void
    {
        $pullRequest->comment($this->data, $this->message);
    }

    public function uniqueId(): string
    {
        return implode(':', [
            $this->data->organization,
            $this->data->repository,
            $this->data->id,
        ]);
    }
}
