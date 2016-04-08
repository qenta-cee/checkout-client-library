<?php

class FakeResponse extends WirecardCEE_QPay_Response_ResponseAbstract
{
    public function getStatus()
    {
        return;
    }
}

class WirecardCEE_QPay_Response_ResponseAbstractTest extends PHPUnit_Framework_TestCase
{
    protected $object;

    public function setUp()
    {
        $response     = WirecardCEE_Stdlib_SerialApi::decode("message=Amount+is+missing.&consumerMessage=Amount+is+missing.");
        $this->object = new FakeResponse($response);
    }

    public function testError()
    {
        $error = $this->object->getError();
        $this->assertInstanceOf('WirecardCEE_QPay_Error', $error);
        $this->assertEquals("Amount is missing.", $error->getConsumerMessage());
    }
}