<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\TranslationData;
use App\Jobs\GitHub\AutoMergeJob;
use GrahamCampbell\GitHub\GitHubManager;

class PullRequest
{
    public function __construct(
        protected GitHubManager $github
    ) {}

    public function machine(TranslationData $data): void
    {
        AutoMergeJob::dispatch($data);
    }

    public function approve(TranslationData $data): void
    {
        $this->github->pullRequest()->reviews()->create(
            $data->organization,
            $data->repository,
            $data->pullRequestId,
            ['event' => 'APPROVE', 'body' => 'Auto approve']
        );
    }

    public function merge(TranslationData $data): void
    {
        $this->github->pullRequest()->merge(
            $data->organization,
            $data->repository,
            $data->pullRequestId,
            $data->body,
            $data->hash
        );
    }
}
