<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class DependabotData extends Data
{
    #[MapInputName('pull_request.number')]
    public int $pullRequestId;

    #[MapInputName('organization.login')]
    public string $organization;

    #[MapInputName('repository.name')]
    public string $repository;
}
