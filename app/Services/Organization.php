<?php

declare(strict_types=1);

namespace App\Services;

use GrahamCampbell\GitHub\GitHubManager;

class Organization
{
    public function __construct(
        protected GitHubManager $github
    ) {}

    public function repositories(string $organization): array
    {
        return $this->github->repositories()->org($organization);
    }
}
