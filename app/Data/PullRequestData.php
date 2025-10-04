<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PullRequestData extends Data
{
    #[MapInputName('repository.owner.login')]
    public string $organization;

    #[MapInputName('repository.name')]
    public string $repository;

    #[MapInputName('pull_request.user.login')]
    public Optional|string $author;

    #[MapInputName('pull_request.number')]
    public int|Optional $id;

    #[MapInputName('pull_request.head.sha')]
    public Optional|string $hash;

    #[MapInputName('pull_request.title')]
    public Optional|string $title;

    #[MapInputName('pull_request.body')]
    public Optional|string|null $body;

    #[MapInputName('pull_request.mergeable')]
    public bool|Optional|null $isMergeable;
}
