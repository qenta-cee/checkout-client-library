<?php

class WirecardCEE_QPay_Return_FailureTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var WirecardCEE_QPay_Return_Failure
     */
    protected $object;

    //qpay
    protected $_returnData = Array(
        'paymentState'    => 'FAILURE',
        'message'         => 'Language is missing.',
        'consumerMessage' => 'Language is missing.'
    );

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new WirecardCEE_QPay_Return_Failure($this->_returnData);
    }

    public function testValidate()
    {
        $this->assertTrue($this->object->validate());
    }

    public function testGetErrors()
    {
        foreach ($this->object->getErrors() as $error) {
            $this->assertEquals('Language is missing.', $error->getMessage());
            $this->assertEquals('Language is missing.', $error->getConsumerMessage());
        }
    }
}

