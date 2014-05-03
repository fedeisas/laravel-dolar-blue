<?php

use Fedeisas\LaravelDolarBlue\LaravelDolarBlue;
use VCR\VCR;

class LaravelDolarBlueTesting extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->service = new LaravelDolarBlue;
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
     * @vcr lanacion_404
     */
    public function testServerNotResponding()
    {
        $result = $this->service->get('LaNacion');
    }

    /**
     * @vcr lanacion
     */
    public function testCallMagicMethodLaNacion()
    {
        $result = $this->service->LaNacion();
        $this->resultAssertions($result);
    }

    /**
     * @vcr lanacion
     */
    public function testLaNacion()
    {
        $result = $this->service->get('LaNacion');
        $this->resultAssertions($result);
    }

    /**
     * @vcr bluelytics
     */
    public function testBlueLytics()
    {
        $result = $this->service->get('BlueLytics');
        $this->resultAssertions($result);
    }

    /**
     * @vcr dolarblue
     */
    public function testDolarBlue()
    {
        $result = $this->service->get('DolarBlue');
        $this->resultAssertions($result);
    }
}
