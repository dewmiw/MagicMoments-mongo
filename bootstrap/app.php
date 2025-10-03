<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register your middleware aliases here
        $middleware->alias([
            'admin'    => \App\Http\Middleware\Admin::class,                 // your role check
            'auth'     => \Illuminate\Auth\Middleware\Authenticate::class,   // <-- use Illuminate here
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);

        // You can also append/prepend global middleware if needed:
        // $middleware->append(\App\Http\Middleware\Something::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
