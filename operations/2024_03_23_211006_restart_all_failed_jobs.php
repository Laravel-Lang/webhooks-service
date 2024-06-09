<?php

declare(strict_types=1);

use DragonCode\LaravelDeployOperations\Operation;

return new class extends Operation {
    protected bool $before = false;

    public function __invoke(): void
    {
        $this->artisan('queue:retry', ['id' => 'all']);
    }
};
