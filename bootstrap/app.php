<?php

use App\Http\Middleware\Handler;
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/console.php',
    )
    ->withMiddleware(new Handler())
    ->withExceptions()
    ->create();
