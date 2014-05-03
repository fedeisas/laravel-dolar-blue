<?php namespace Fedeisas\LaravelDolarBlue;

use Illuminate\Support\ServiceProvider;

class LaravelDolarBlueServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     * @see http://laravel.com/docs/packages#deferred-providers
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('fedeisas/laravel-dolar-blue');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Do nothing
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
