<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\PullRequestData;
use App\Jobs\GitHub\DependabotJob;

class Dependabot
{
    public function merge(PullRequestData $data): void
    {
        DependabotJob::dispatch($data)->delay(
            config('github.dependabot.delay')
        );
    }
}
