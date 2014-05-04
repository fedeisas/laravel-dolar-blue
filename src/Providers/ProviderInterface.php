<?php namespace Fedeisas\LaravelDolarBlue\Providers;

interface ProviderInterface
{
    /**
     * Parse response
     * @param string $response
     * @return array
     */
    public function parse($response);

    /**
     * Returns Provide's URL
     * @return string
     */
    public function getUrl();
}
