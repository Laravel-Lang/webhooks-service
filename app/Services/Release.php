<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\ReleaseData;
use App\Jobs\Boosty\PublishJob;

class Release
{
    public function publish(ReleaseData $data): void
    {
        $this->publishToBoosty($data);
    }

    protected function publishToBoosty(ReleaseData $data): void
    {
        PublishJob::dispatch(
            $data->repository,
            $data->version,
            $data->changelog,
            $data->url
        );
    }
}
