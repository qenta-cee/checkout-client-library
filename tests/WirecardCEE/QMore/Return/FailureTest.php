<?php

class WirecardCEE_QMore_Return_FailureTest extends PHPUnit_Framework_TestCase
{

    protected $object;

    protected $_returnData = Array(
        'errors'       => '1',
        'error'        => Array(
            Array(
                'message'         => 'Language is missing.',
                'errorCode'       => '11009',
                'consumerMessage' => 'Language is missing.',
                'paySysMessage'   => 'QMORE paysysmessage'
            )
        ),
        'paymentState' => 'FAILURE'
    );


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new WirecardCEE_QMore_Return_Failure($this->_returnData);
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
            $this->assertEquals('11009', $error->getErrorCode());
            $this->assertEquals('QMORE paysysmessage', $error->getPaySysMessage());
        }
    }

    public function testGetNumberOfErrors()
    {
        $this->assertEquals(1, $this->object->getNumberOfErrors());
    }
}

