<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  protected $middleware = [
    // Global middleware
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
  ];

  protected $middlewareGroups = [
    'web' => [
      // Middleware for web routes
    ],

    'api' => [
      'throttle:api',
      'bindings',
    ],
  ];

  protected $routeMiddleware = [
    // Custom route middleware
    'admin' => \App\Http\Middleware\Admin::class,
    'merchant' => \App\Http\Middleware\Merchant::class

  ];
}
