<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- This is the crucial new import

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register application services here when the MVP needs them.
    }

    public function boot(): void
    {
        // Force HTTPS when deployed to Vercel so browsers don't block the CSS/JS
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}