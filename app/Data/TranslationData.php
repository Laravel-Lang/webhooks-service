<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class TranslationData extends Data
{
    #[MapInputName('repository.owner.login')]
    public string $organization;

    #[MapInputName('repository.name')]
    public string $repository;

    #[MapInputName('pull_request.number')]
    public int $pullRequestId;

    #[MapInputName('pull_request.body')]
    public ?string $body;

    #[MapInputName('pull_request.head.sha')]
    public string $hash;
}
