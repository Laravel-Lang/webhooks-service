<?php

namespace App\Providers;

use App\Services\Telegram;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->telegram();
    }

    protected function telegram(): void
    {
        $this->app->singleton(Telegram::class, fn () => new Telegram(
            config('services.telegram.token'),
            config('services.telegram.chats')
        ));
    }
}
