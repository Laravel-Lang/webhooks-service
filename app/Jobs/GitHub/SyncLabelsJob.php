<?php

declare(strict_types=1);

namespace App\Jobs\GitHub;

use App\Data\PullRequestData;
use App\Jobs\Job;
use App\Services\PullRequest;

class SyncLabelsJob extends Job
{
    public function __construct(
        public PullRequestData $data
    ) {}

    public function handle(PullRequest $pullRequest): void
    {
        $this->create($pullRequest);
        $this->remove($pullRequest);
    }

    protected function create(PullRequest $pullRequest): void
    {
        foreach ($this->toCreate() as $name => $values) {
            $this->updateOrCreate($pullRequest, $name, [
                'name'        => $name,
                'color'       => $values[0],
                'description' => $values[1],
            ]);
        }
    }

    protected function remove(PullRequest $pullRequest): void
    {
        foreach ($this->toRemove() as $name) {
            $pullRequest->removeLabel($this->data, $name);
        }
    }

    protected function updateOrCreate(PullRequest $pullRequest, string $name, array $params): void
    {
        $pullRequest->createLabel($this->data, $name, $params);
    }

    protected function toCreate(): array
    {
        return config('github.labels.create', []);
    }

    protected function toRemove(): array
    {
        return config('github.labels.delete', []);
    }
}
