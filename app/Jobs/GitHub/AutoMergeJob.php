<?php

declare(strict_types=1);

namespace App\Jobs\GitHub;

use App\Data\PullRequestData;
use App\Jobs\Job;
use App\Services\PullRequest;
use Github\Exception\ApiLimitExceedException;

class AutoMergeJob extends Job
{
    public function __construct(
        public PullRequestData $data
    ) {}

    public function handle(PullRequest $pullRequest): void
    {
        $this->releaseAfter(function () use ($pullRequest) {
            if (is_bool($this->data->isMergeable) && ! $this->data->isMergeable) {
                $pullRequest->close($this->data);

                return;
            }

            if (! $pullRequest->wasApproved($this->data)) {
                $pullRequest->approve($this->data);
            }

            $pullRequest->merge($this->data);
        }, ApiLimitExceedException::class);
    }

    public function failed(): void
    {
        app(PullRequest::class)->close($this->data);
    }
}
