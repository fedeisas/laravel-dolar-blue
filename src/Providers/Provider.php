<?php namespace Fedeisas\LaravelDolarBlue\Providers;

use \Exception;

abstract class Provider
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $endpointUrl;

    /**
     * Returns Provider's URL
     * @return string $url
     */
    public function getUrl()
    {
        $url = $this->baseUrl . $this->endpointUrl;
        return $url;
    }
}
