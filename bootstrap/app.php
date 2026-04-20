<?php

use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsStudent;
use App\Http\Middleware\EnsureUserIsApproved;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    /**
     * alias is a method used to define a shortcut name for a middleware.
     *  It is also used when assigning middleware to a specific route.
     *  e.g Route::middleware('approved')->group(function () {
     *        // routes 
     *   });
     */
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([ 
            'approved' => EnsureUserIsApproved::class,
            'admin' => EnsureIsAdmin::class,
            'student' => EnsureIsStudent::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
