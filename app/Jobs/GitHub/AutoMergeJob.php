<?php

declare(strict_types=1);

namespace App\Jobs\GitHub;

use App\Data\PullRequestData;
use App\Jobs\Job;
use App\Services\PullRequest;

class AutoMergeJob extends Job
{
    public function __construct(
        public PullRequestData $data
    ) {}

    public function handle(PullRequest $pullRequest): void
    {
        $pullRequest->approve($this->data);
        $pullRequest->merge($this->data);
    }
}
