<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureDatabase();
        $this->configureModels();
        $this->configureAuthentication();
        $this->configureUrl();
        $this->configureRequests();
    }

    private function configureDatabase(): void
    {
        DB::prohibitDestructiveCommands((bool) $this->app->environment('production'));
    }

    private function configureModels(): void
    {
        $strict = ! $this->app->environment('production');

        Model::shouldBeStrict($strict);
        Model::preventLazyLoading($strict);
    }

    private function configureAuthentication(): void
    {
        Authenticate::redirectUsing(fn () => null);
    }

    private function configureUrl(): void
    {
        URL::forceHttps(str_starts_with(config()->string('app.url'), 'https://'));
    }

    private function configureRequests(): void
    {
        FormRequest::failOnUnknownFields();
    }
}
