<?php

declare(strict_types=1);

use App\Console\Commands\RegisterWebhooks;
use DragonCode\LaravelActions\Action;

return new class extends Action {
    protected bool $once = false;

    protected bool $before = false;

    public function __invoke(): void
    {
        $this->artisan(RegisterWebhooks::class);
    }
};
