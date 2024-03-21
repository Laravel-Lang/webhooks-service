<?php

declare(strict_types=1);

namespace App\Console\Commands;

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class RegisterWebhooks extends Command
{
    protected $signature = 'webhooks:register';

    protected $description = 'Registering webhooks for bots';

    public function handle(): void
    {
        $this->bots()->each(
            fn (TelegraphBot $bot) => $bot->registerWebhook()->send()
        );
    }

    protected function bots(): Collection
    {
        return TelegraphBot::get();
    }
}
