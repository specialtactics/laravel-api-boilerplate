<?php

namespace App\Providers;

use App\Exceptions\ApiExceptionHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerExceptionHandler();
        $this->registerTelescope();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register the exception handler - extends the Dingo one
     *
     * @return void
     */
    protected function registerExceptionHandler(): void
    {
        $this->app->singleton('api.exception', function ($app) {
            $config = $app->config->get('api');
            return new ApiExceptionHandler($app['Illuminate\Contracts\Debug\ExceptionHandler'], $config['errorFormat'], $config['debug']);
        });
    }

    /**
     * Conditionally register the telescope service provider
     */
    protected function registerTelescope(): void
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
