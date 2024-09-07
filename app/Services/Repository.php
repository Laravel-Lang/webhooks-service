<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\RepositoryData;
use App\Jobs\GitHub\ConnectRepositoryJob;
use GrahamCampbell\GitHub\GitHubManager;

class Repository
{
    public function __construct(
        protected GitHubManager $github
    ) {
    }

    public function connect(RepositoryData $data): void
    {
        ConnectRepositoryJob::dispatch($data->organization, $data->repository);
    }

    public function createLabel(string $organization, string $repository, string $name, array $params): void
    {
        rescue(
            fn () => $this->github->repository()->labels()->update(
                $organization,
                $repository,
                $name,
                $params
            ),
            fn () => $this->github->repository()->labels()->create(
                $organization,
                $repository,
                $params
            ),
            false
        );
    }

    public function removeLabel(string $organization, string $repository, string $name): void
    {
        rescue(fn () => $this->github->repository()->labels()->remove(
            $organization,
            $repository,
            $name
        ), report: false);
    }
}
