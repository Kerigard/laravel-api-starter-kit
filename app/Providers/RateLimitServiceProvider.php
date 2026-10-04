<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RateLimitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureApiV1();
    }

    private function configureApiV1(): void
    {
        RateLimiter::for(
            'api-v1',
            fn (Request $request) => Limit::perMinute(60)->by($request->user()?->id ?: $request->ip())
        );
    }
}
