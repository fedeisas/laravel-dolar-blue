<?php namespace Fedeisas\LaravelDolarBlue\Providers;

class LaNacion extends Provider implements ProviderInterface
{
    /**
     * Provider's base URL
     * @var string
     */
    protected $baseURL = 'http://contenidos.lanacion.com.ar/';

    /**
     * Provider's endpoint URL
     * @var string
     */
    protected $endpointURL = 'json/dolar';

    /**
     * Parse Provider's Response
     * @param GuzzleHttp\Message\Response $response
     * @return array $result
     */
    protected function parse($response)
    {
        $body = (string) $response->getBody();
        $json = json_decode(substr($body, 19, strlen($body) - 19 - 2));

        $buy = number_format(
            preg_replace('/,/', '.', $json->InformalVentaValue),
            2
        );

        $sell = number_format(
            preg_replace('/,/', '.', $json->InformalCompraValue),
            2
        );

        return array(
            'buy' => $buy,
            'sell' => $sell,
            'timestamp' => time(),
        );
    }
}
