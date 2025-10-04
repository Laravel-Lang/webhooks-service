<?php

declare(strict_types=1);

use DragonCode\LaravelDeployOperations\Operation;

return new class extends Operation {
    public function needBefore(): bool
    {
        return false;
    }

    public function __invoke(): void
    {
        $this->artisan('queue:retry', [
            '--queue' => 'releases',
        ]);
    }
};
