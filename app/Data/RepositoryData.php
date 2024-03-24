<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class RepositoryData extends Data
{
    #[MapInputName('repository.owner.login')]
    public string $organization;

    #[MapInputName('repository.name')]
    public string $repository;
}
