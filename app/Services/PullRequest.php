<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\PullRequestData;
use App\Jobs\GitHub\AutoMergeJob;
use App\Jobs\GitHub\DependabotJob;
use GrahamCampbell\GitHub\GitHubManager;

class PullRequest
{
    protected string $autoApproveMessage = 'Auto approve';

    public function __construct(
        protected GitHubManager $github,
        protected TeamParser $teamParser,
    ) {}

    public function autoMerge(PullRequestData $data): void
    {
        AutoMergeJob::dispatch($data)->delay(
            config('github.pull_request.delay')
        );
    }

    public function approve(PullRequestData $data): void
    {
        $this->github->pullRequest()->reviews()->create(
            $data->organization,
            $data->repository,
            $data->id,
            ['event' => 'APPROVE', 'body' => $this->autoApproveMessage]
        );
    }

    public function wasApproved(PullRequestData $data): bool
    {
        $reviews = $this->github->pullRequest()->reviews()->all(
            $data->organization,
            $data->repository,
            $data->id
        );

        foreach ($reviews as $review) {
            if ($review['body'] === $this->autoApproveMessage) {
                return true;
            }
        }

        return false;
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

    public function dependabot(PullRequestData $data): void
    {
        DependabotJob::dispatch($data)->delay(
            config('github.dependabot.delay')
        );
    }
}
