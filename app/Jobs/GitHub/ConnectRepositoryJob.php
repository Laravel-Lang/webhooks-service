<?php

declare(strict_types=1);

namespace App\Jobs\GitHub;

use App\Jobs\Job;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ConnectRepositoryJob extends Job implements ShouldBeUnique
{
    public function __construct(
        public string $organization,
        public string $repository,
        public bool $withWebhooks = true
    ) {}

    public function handle(): void
    {
        SyncLabelsJob::dispatch($this->organization, $this->repository);
    }

    public function uniqueId(): string
    {
        return $this->organization . ':' . $this->repository;
    }
}
