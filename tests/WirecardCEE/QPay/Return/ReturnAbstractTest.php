<?php

class WirecardCEE_QPay_Return_ReturnAbstractTestObject extends WirecardCEE_Stdlib_Return_ReturnAbstract
{
    public function validate()
    {
        return true;
    }
}

/**
 * Test class for WirecardCEE_Client_QPay_Return_Abstract.
 */
class WirecardCEE_QPay_Return_ReturnAbstractTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var WirecardCEE_QPay_Return_ReturnAbstractTestObject
     */
    protected $object;

    protected $_returnData = Array(
        'paymentState' => 'CANCEL'
    );

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new WirecardCEE_QPay_Return_ReturnAbstractTestObject($this->_returnData);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() { }

    public function testMagicGetPaymentState()
    {
        $this->assertEquals('CANCEL', $this->object->paymentState);
    }

    public function testPaymentState()
    {
        $this->assertEquals('', $this->object->getPaymentState());
    }

    public function testMagicGetNotSet()
    {
        $this->assertEquals(null, $this->object->invalid);
    }

    public function testValidate()
    {
        $this->assertTrue($this->object->validate());
    }

    public function testGetReturned()
    {
        $this->assertEquals($this->_returnData, $this->object->getReturned());
    }

    public function testGetReturnedButUnsetArrayFields()
    {
        $returnData                             = Array();
        $returnData['paymentState']             = 'CANCEL';
        $returnData['responseFingerprintOrder'] = 'TEST';
        $returnData['responseFingerprint']      = 'TEST';

        $object = new WirecardCEE_QPay_Return_ReturnAbstractTestObject($returnData);
        $object->getReturned();

        $this->assertFalse(isset( $this->_returnData['responseFingerprintOrder'] ));
        $this->assertFalse(isset( $this->_returnData['responseFingerprint'] ));
    }
}
