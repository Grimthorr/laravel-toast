<?php

namespace Grimthorr\LaravelToast;


class ServiceProvider extends \Illuminate\Support\ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('laravel-toast.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../views' => base_path('resources/views/vendor/toast'),
        ], 'views');

        $this->loadViewsFrom(__DIR__ . '/../views', 'toast');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('toast', 'Grimthorr\LaravelToast\Toast');

        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'laravel-toast'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
