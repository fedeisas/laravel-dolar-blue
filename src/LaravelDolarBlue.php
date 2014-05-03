<?php namespace Fedeisas\LaravelDolarBlue;

use \InvalidArgumentException;

class LaravelDolarBlue
{

    /**
     * Returns provider's parsed result
     * @param string $provider Provider's name. Default LaNacion
     * @return array Result set.
     */
    public function get($provider = 'LaNacion')
    {
        $className = 'Fedeisas\LaravelDolarBlue\Providers\\' . $provider;

        if (class_exists($className)) {
            $providerInstance = new $className;
            return $providerInstance->get();
        } else {
            throw new InvalidArgumentException('Unknown provider: ' . $provider);
        }
    }

    /**
     * Magic method for calling providers
     * @param string $method
     * @param array $attributes
     * @return array Result set.
     */
    public function __call($method, $attributes = array())
    {
        return $this->get($method);
    }
}
