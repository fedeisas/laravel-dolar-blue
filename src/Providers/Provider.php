<?php namespace Fedeisas\LaravelDolarBlue\Providers;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use \Exception;

abstract class Provider
{
    /**
     * @var Guzzle\Http\Client
     */
    protected $client;

    /**
     * @param Guzzle\Http\Client $client
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->client->setBaseUrl($this->baseUrl);
    }

    /**
     * Fetch and parse provider's result
     * @return array
     */
    public function get()
    {
        $response = $this->fetch($this->endpointUrl);
        return $this->parse($response);
    }

    /**
     * Fetch Provider's URL with Guzzle
     * @param string $url
     * @throws GuzzleHttp\Exception\RequestException If server timesout
     * @throws Exception If server response is not 200 OK
     * @return GuzzleHttp\Message\Response $request
     */
    protected function fetch($url)
    {
        try {
            $request = $this->client->get($url)->send();
        } catch (ClientErrorResponseException $e) {
            throw new Exception('Server timeout.');
        }

        if ($request->getStatusCode() == 200) {
            return $request;
        } else {
            throw new Exception('Server not responding.');
        }
    }
}
