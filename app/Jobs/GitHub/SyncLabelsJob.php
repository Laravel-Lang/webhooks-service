<?php

declare(strict_types=1);

namespace App\Jobs\GitHub;

use App\Data\CreatedRepositoryData;
use App\Jobs\Job;
use GrahamCampbell\GitHub\GitHubManager;

class SyncLabelsJob extends Job
{
    public function __construct(
        public CreatedRepositoryData $data
    ) {}

    public function handle(GitHubManager $github): void
    {
        $this->create($github);
        $this->remove($github);
    }

    protected function create(GitHubManager $github): void
    {
        foreach ($this->toCreate() as $name => $values) {
            $this->updateOrCreate($github, $name, [
                'name'        => $name,
                'color'       => $values[0],
                'description' => $values[1],
            ]);
        }
    }

    protected function remove(GitHubManager $github): void
    {
        foreach ($this->toRemove() as $name) {
            $this->removeLabel($github, $name);
        }
    }

    protected function updateOrCreate(GitHubManager $github, string $name, array $params): void
    {
        rescue(
            fn () => $github->repository()->labels()->update(
                $this->data->organization,
                $this->data->repository,
                $name,
                $params
            ),
            fn () => $github->repository()->labels()->create(
                $this->data->organization,
                $this->data->repository,
                $params
            )
        );
    }

    protected function removeLabel(GitHubManager $github, string $name): void
    {
        rescue(fn () => $github->repository()->labels()->remove(
            $this->data->organization,
            $this->data->repository,
            $name,
        ));
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
