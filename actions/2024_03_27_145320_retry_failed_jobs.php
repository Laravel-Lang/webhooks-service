<?php

declare(strict_types=1);

use DragonCode\LaravelActions\Action;

return new class extends Action {
    protected bool $before = false;

    public function __invoke(): void
    {
        $this->artisan('queue:retry', ['id' => 'all']);
    }
};
