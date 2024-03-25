<?php

declare(strict_types=1);

namespace App\Jobs\Boosty;

use App\Integrations\Boosty;
use App\Jobs\Job;

class PublishJob extends Job
{
    public function __construct(
        public string $organization,
        public string $repository,
        public string $version,
        public string $changelog,
        public string $url
    ) {}

    public function handle(Boosty $boosty): void
    {
        $boosty->publish(
            sprintf('%s %s %s released', $this->organization, $this->repository, $this->version),
            $this->changelog,
            $this->url,
            $this->repository
        );
    }
}
