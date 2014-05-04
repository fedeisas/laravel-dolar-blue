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
        $this->app['fedeisas.laravel-dolar-blue'] = $this->app->share(function ($app) {
            $client = new Guzzle\Http\Client;
            return new LaravelDolarBlue($client);
        });
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
