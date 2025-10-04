<?php

declare(strict_types=1);

use App\Jobs\GitHub\ConnectOrganizationJob;
use DragonCode\LaravelDeployOperations\Operation;

return new class extends Operation {
    protected bool $before = false;

    protected string $organization = 'Laravel-Lang';

    public function __invoke(): void
    {
        ConnectOrganizationJob::dispatch($this->organization);
    }
};
