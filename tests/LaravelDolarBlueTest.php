<?php

use Fedeisas\LaravelDolarBlue\LaravelDolarBlue;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;

class LaravelDolarBlueTesting extends PHPUnit_Framework_TestCase
{

    /**
     * @var Fedeisas\LaravelDolarBlue\LaravelDolarBlue
     */
    protected $service;

    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = new Client;
        $this->service = new LaravelDolarBlue($this->client);
    }

    private function mockGuzzle($response)
    {
        $this->client = new Client;

        $mock = new Mock(array(
            file_get_contents(__DIR__ . '/fixtures/' . $response)
        ));

        $this->client->getEmitter()->attach($mock);

        $this->service = new LaravelDolarBlue($this->client);
    }

    /**
     * Common assertions for every provider's test
     * @param array $result
     */
    private function resultAssertions($result)
    {
        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('sell', $result);
        $this->assertArrayHasKey('buy', $result);
        $this->assertArrayHasKey('timestamp', $result);
        $this->assertTrue($result['buy'] > 0);
        $this->assertTrue($result['sell'] > 0);
        $this->assertTrue(is_numeric($result['buy']));
        $this->assertTrue(is_numeric($result['sell']));
        $this->assertTrue($result['buy'] == 10.50);
        $this->assertTrue($result['sell'] == 10.50);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetWrongProvider()
    {
        $result = $this->service->get('WrongProvider');
    }

    /**
     * @expectedException Exception
     */
    public function testServerNotResponding()
    {
        $this->mockGuzzle('lanacion_404.txt');
        $result = $this->service->get('LaNacion');
    }

    /**
     * @expectedException Exception
     */
    public function testMalformedData()
    {
        $this->mockGuzzle('lanacion_malformed.txt');
        $result = $this->service->get('LaNacion');
    }

    public function testCallMagicMethodLaNacion()
    {
        $this->mockGuzzle('lanacion_200.txt');
        $result = $this->service->LaNacion();
        $this->resultAssertions($result);
    }

    public function testLaNacion()
    {
        $this->mockGuzzle('lanacion_200.txt');
        $result = $this->service->get('LaNacion');
        $this->resultAssertions($result);
    }

    public function testBlueLytics()
    {
        $this->mockGuzzle('bluelytics_200.txt');
        $result = $this->service->get('BlueLytics');
        $this->resultAssertions($result);
    }

    public function testDolarBlue()
    {
        $this->mockGuzzle('dolarblue_200.txt');
        $result = $this->service->get('DolarBlue');
        $this->resultAssertions($result);
    }
}
