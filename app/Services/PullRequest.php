<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\PullRequestData;
use App\Jobs\GitHub\AutoMergeJob;
use GrahamCampbell\GitHub\GitHubManager;

class PullRequest
{
    public function __construct(
        protected GitHubManager $github,
        protected TeamParser $teamParser,
    ) {}

    public function approveMachine(PullRequestData $data): void
    {
        AutoMergeJob::dispatch($data);
    }

    public function approve(PullRequestData $data): void
    {
        $this->github->pullRequest()->reviews()->create(
            $data->organization,
            $data->repository,
            $data->id,
            ['event' => 'APPROVE', 'body' => 'Auto approve']
        );
    }

    public function merge(PullRequestData $data): void
    {
        $this->github->pullRequest()->merge(
            $data->organization,
            $data->repository,
            $data->id,
            $data->body,
            $data->hash
        );
    }

    public function assign(PullRequestData $data): void
    {
        $users = $this->teamParser->forLocale($data->title);

        $this->github->issues()->assignees()->add(
            $data->organization,
            $data->repository,
            $data->id,
            ['assignees' => $users->all()]
        );

        $this->github->pullRequest()->reviewRequests()->create(
            $data->organization,
            $data->repository,
            $data->id,
            $users->reject(fn (string $user) => $user === $data->author)->all()
        );
    }

    public function comment(PullRequestData $data, string $body): void
    {
        $this->github->issues()->comments()->create(
            $data->organization,
            $data->repository,
            $data->id,
            compact('body')
        );
    }
}
