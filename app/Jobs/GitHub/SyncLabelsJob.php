<?php

declare(strict_types=1);

namespace App\Jobs\GitHub;

use App\Jobs\Job;
use App\Services\Repository;
use Github\Exception\ApiLimitExceedException;

class SyncLabelsJob extends Job
{
    public function __construct(
        public string $organization,
        public string $repository
    ) {
    }

    public function handle(Repository $repository): void
    {
        $this->releaseAfter(function () use ($repository) {
            $this->create($repository);
            $this->remove($repository);
        }, ApiLimitExceedException::class);
    }

    protected function create(Repository $repository): void
    {
        foreach ($this->toCreate() as $name => $values) {
            $this->updateOrCreate($repository, $name, [
                'name'        => $name,
                'color'       => $values[0],
                'description' => $values[1],
            ]);
        }
    }

    protected function remove(Repository $repository): void
    {
        foreach ($this->toRemove() as $name) {
            $repository->removeLabel($this->organization, $this->repository, $name);
        }
    }

    protected function updateOrCreate(Repository $repository, string $name, array $params): void
    {
        $repository->createLabel($this->organization, $this->repository, $name, $params);
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
