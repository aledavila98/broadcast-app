<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CorsMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(CorsMiddleware::class);
        $middleware->validateCsrfTokens(except: [
            'http://localhost:8001/*',
            'http://localhost:8000/broadcast',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
