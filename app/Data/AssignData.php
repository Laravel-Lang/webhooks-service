<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class AssignData extends Data
{
    #[MapInputName('repository.owner.login')]
    public string $organization;

    #[MapInputName('repository.name')]
    public string $repository;

    #[MapInputName('pull_request.number')]
    public string $pullRequestId;

    #[MapInputName('pull_request.user.login')]
    public string $pullRequestAuthor;

    #[MapInputName('pull_request.title')]
    public string $title;
}
