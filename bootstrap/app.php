<?php

declare(strict_types=1);

use App\Exceptions\ExceptionHandler;
use App\Http\Middleware\MiddlewareHandler;
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(new MiddlewareHandler)
    ->withExceptions(new ExceptionHandler)
    ->withCommands()
    ->withRouting(
        api     : __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
    )->create();
