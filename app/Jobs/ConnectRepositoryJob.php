<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Jobs\GitHub\SyncLabelsJob;
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
        $this->labels();
    }

    public function uniqueId(): string
    {
        return $this->organization . ':' . $this->repository;
    }

    protected function labels(): void
    {
        SyncLabelsJob::dispatch($this->organization, $this->repository);
    }
}
