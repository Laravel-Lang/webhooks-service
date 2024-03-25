<?php

declare(strict_types=1);

namespace App\Providers;

use App\Integrations\Boosty;
use Illuminate\Support\ServiceProvider;

class IntegrationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(Boosty::class, fn () => new Boosty(
            config('services.boosty.token'),
            config('services.boosty.blog'),
        ));
    }
}
