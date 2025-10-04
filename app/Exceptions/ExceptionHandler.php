<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Configuration\Exceptions;
use Sentry\Laravel\Integration;

class ExceptionHandler
{
    public function __invoke(Exceptions $exceptions): void
    {
        Integration::handles($exceptions);
    }
}
