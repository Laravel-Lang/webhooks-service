<?php

declare(strict_types=1);

use App\Jobs\GitHub\ConnectOrganizationJob;
use DragonCode\LaravelActions\Action;

return new class extends Action {
    protected bool $before = false;

    protected string $organization = 'Laravel-Lang';

    public function __invoke(): void
    {
        ConnectOrganizationJob::dispatch($this->organization);
    }
};
