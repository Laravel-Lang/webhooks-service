<?php

declare(strict_types=1);

namespace App\Services;

use Github\ResultPager;
use GrahamCampbell\GitHub\GitHubManager;

class Organization
{
    public function __construct(
        protected GitHubManager $github,
        protected ResultPager $paginator
    ) {
    }

    public function repositories(string $organization): array
    {
        return $this->paginator->fetchAll($this->github->repositories(), 'org', [$organization]);
    }
}
