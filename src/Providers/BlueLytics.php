<?php namespace Fedeisas\LaravelDolarBlue\Providers;

class BlueLytics extends Provider implements ProviderInterface
{
    /**
     * Provider's base URL
     * @var string
     */
    protected $baseUrl = 'http://bluelytics.com.ar/';

    /**
     * Provider's endpoint URL
     * @var string
     */
    protected $endpointUrl = 'json/last_price';

    /**
     * Parse Provider's Response
     * @param GuzzleHttp\Message\Response $response
     * @return array $result
     */
    protected function parse($response)
    {
        $body = (string) $response->getBody();
        $json = json_decode($body);

        $sources = array_filter($json, function ($source) {
            return $source->source != 'oficial';
        });

        $sourcesBuy = array_map(function ($source) {
            return $source->value_buy;
        }, $sources);

        $buy = number_format(
            array_sum($sourcesBuy) / count($sourcesBuy),
            2
        );

        $sourcesSell = array_map(function ($source) {
            return $source->value_sell;
        }, $sources);

        $sell = number_format(
            array_sum($sourcesSell) / count($sourcesSell),
            2
        );

        return array(
            'buy' => $buy,
            'sell' => $sell,
            'timestamp' => time(),
        );
    }
}
