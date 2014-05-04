<?php namespace Fedeisas\LaravelDolarBlue;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use \InvalidArgumentException;
use \Exception;

class LaravelDolarBlue
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Instance provider, fetch endpoint, and returns provider's parsed result
     * @param string $provider Provider's name. Default LaNacion
     * @throws InvalidArgumentException If unknown provider
     * @throws Exception If can't parse result
     * @return array Result set.
     */
    public function get($provider = 'LaNacion')
    {
        $className = 'Fedeisas\LaravelDolarBlue\Providers\\' . $provider;

        // Check if is a valid provider and instantiate it
        if (class_exists($className)) {
            $providerInstance = new $className;
        } else {
            throw new InvalidArgumentException('Unknown provider: ' . $provider);
        }

        // Fetch Provider's response using Guzzle and
        // parse response with Provider's custom method
        try {
            $request = $this->client->get($providerInstance->getUrl());
            $result = $providerInstance->parse($request);
        } catch (BadResponseException $e) {
            throw new Exception('Server not responding.');
        } catch (Exception $e) {
            throw new Exception('Malformed response.');
        }

        // Return parsed result
        return $result;
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
