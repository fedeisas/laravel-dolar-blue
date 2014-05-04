<?php namespace Fedeisas\LaravelDolarBlue\Facade;

use Illuminate\Support\Facades\Facade;

class LaravelDolarBlue extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Fedeisas\LaravelDolarBlue\LaravelDolarBlue';
    }
}
