<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend(\Psr\Log\LoggerInterface::class, function ($logger, $app) {
            return new \Bugsnag\BugsnagLaravel\MultiLogger([$logger, $app['bugsnag.logger']]);
        });
    }
}
