<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\DependabotData;
use App\Jobs\GitHub\DependabotJob;

class Dependabot
{
    public function merge(DependabotData $data): void
    {
        DependabotJob::dispatch(
            $data->organization,
            $data->repository,
            $data->pullRequestId
        )->delay(config('github.dependabot.delay'));
    }
}
