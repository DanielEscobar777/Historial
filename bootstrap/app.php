<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ValidarTokenExterno;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Alias opcional para usar en rutas
        $middleware->alias([
            'externalauth' => ValidarTokenExterno::class,
        ]);

        // Insertar en el grupo 'web'
        $middleware->appendToGroup('web', ValidarTokenExterno::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
