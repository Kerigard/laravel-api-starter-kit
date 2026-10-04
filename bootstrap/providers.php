<?php

use App\Providers\AppServiceProvider;
use App\Providers\MacroServiceProvider;
use App\Providers\RateLimitServiceProvider;

return [
    AppServiceProvider::class,
    MacroServiceProvider::class,
    RateLimitServiceProvider::class,
];
