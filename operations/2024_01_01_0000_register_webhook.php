<?php

declare(strict_types=1);

use App\Console\Commands\RegisterWebhooks;
use DragonCode\LaravelDeployOperations\Operation;

return new class extends Operation {
    public function shouldOnce(): bool
    {
        return false;
    }

    public function needBefore(): bool
    {
        return false;
    }

    public function shouldRun(): bool
    {
        return app()->isProduction();
    }

    public function __invoke(): void
    {
        $this->artisan(RegisterWebhooks::class);
    }
};
