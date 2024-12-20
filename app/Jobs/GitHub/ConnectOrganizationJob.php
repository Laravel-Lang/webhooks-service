<?php

declare(strict_types=1);

namespace App\Jobs\GitHub;

use App\Jobs\Job;
use App\Services\Organization;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ConnectOrganizationJob extends Job implements ShouldBeUnique
{
    public function __construct(
        public string $organization
    ) {}

    public function handle(Organization $organization): void
    {
        foreach ($organization->repositories($this->organization) as $repository) {
            ConnectRepositoryJob::dispatch($this->organization, $repository['name'], false);
        }
    }

    public function uniqueId(): string
    {
        return $this->organization;
    }
}
