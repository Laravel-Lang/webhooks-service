<?php

declare(strict_types=1);



use App\Console\Commands\RegisterWebhooks;
use DragonCode\LaravelDeployOperations\Operation;

return new class extends Operation {
    protected bool $once = false;

    protected bool $before = false;

    public function __invoke(): void
    {
        $this->artisan(RegisterWebhooks::class);
    }
};
