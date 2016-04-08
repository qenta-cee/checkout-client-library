<?php

/**
 * WirecardCEE_QMore_ReturnFactory test case.
 */
class WirecardCEE_QMore_ReturnFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';

    /**
     *
     * @var WirecardCEE_QMore_ReturnFactory
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->object = null;
        parent::tearDown();
    }

    /**
     * Tests WirecardCEE_QMore_ReturnFactory::getInstance()
     */
    public function testGetInstance()
    {
        $return = Array(
            'paymentState' => WirecardCEE_QMore_ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'CCARD'
        );

        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
        $this->assertTrue(is_object($oInstance));
    }

    public function testSuccessInstance()
    {
        $return = Array(
            'paymentState' => WirecardCEE_QMore_ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'CCARD'
        );

        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf('WirecardCEE_QMore_Return_Success_CreditCard', $oInstance);
    }

    public function testSuccessPaypalInstance()
    {
        $return = Array(
            'paymentState' => WirecardCEE_QMore_ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'Paypal'
        );

        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf('WirecardCEE_QMore_Return_Success_PayPal', $oInstance);
    }

    public function testSuccessSofortueberweisungInstance()
    {
        $return = Array(
            'paymentState' => WirecardCEE_QMore_ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'SOFORTUEBERWEISUNG'
        );

        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf('WirecardCEE_QMore_Return_Success_Sofortueberweisung', $oInstance);
    }

    public function testSuccessIdealInstance()
    {
        $return = Array(
            'paymentState' => WirecardCEE_QMore_ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'IDL'
        );

        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf('WirecardCEE_QMore_Return_Success_Ideal', $oInstance);
    }

    public function testSuccessDefaultInstance()
    {
        $return = Array(
            'paymentState' => WirecardCEE_QMore_ReturnFactory::STATE_SUCCESS,
            'paymentType'  => ''
        );

        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf('WirecardCEE_QMore_Return_Success', $oInstance);
    }

    /**
     * @expectedException WirecardCEE_QMore_Exception_InvalidResponseException
     */
    public function testInstanceWIthNoPaymentType()
    {
        $return = Array(
            'paymentState' => WirecardCEE_QMore_ReturnFactory::STATE_SUCCESS
        );

        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
    }

    public function testFailureState()
    {
        $return = Array(
            'paymentState' => WirecardCEE_QMore_ReturnFactory::STATE_FAILURE
        );

        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf('WirecardCEE_QMore_Return_Failure', $oInstance);
    }

    public function testCancelState()
    {
        $return = Array(
            'paymentState' => WirecardCEE_QMore_ReturnFactory::STATE_CANCEL,
            'paymentType'  => 'CCARD'
        );

        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf('WirecardCEE_QMore_Return_Cancel', $oInstance);
    }

    /**
     * @expectedException WirecardCEE_QMore_Exception_InvalidResponseException
     */
    public function testNoState()
    {
        $return    = Array(
            'paymentState' => 999
        );
        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
    }

    /**
     * @expectedException WirecardCEE_QMore_Exception_InvalidResponseException
     */
    public function testInstanceWithEmptyPaymentStateInArray()
    {
        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance(Array(), $this->_secret);
    }

    /**
     * @expectedException WirecardCEE_QMore_Exception_InvalidResponseException
     */
    public function testWhenReturnIsNotArray()
    {
        $return    = "";
        $oInstance = WirecardCEE_QMore_ReturnFactory::getInstance($return, $this->_secret);
    }

    public function testGenerateConfirmResponseNOKString()
    {
        $response = WirecardCEE_QMore_ReturnFactory::generateConfirmResponseString('nok test');
        $this->assertEquals('<QPAY-CONFIRMATION-RESPONSE result="NOK" message="nok test" />',
            $response);
    }

    public function testGenerateConfirmResponseHtmlCommentNOKString()
    {
        $response = WirecardCEE_QMore_ReturnFactory::generateConfirmResponseString('nok test', true);
        $this->assertEquals('<!--<QPAY-CONFIRMATION-RESPONSE result="NOK" message="nok test" />-->',
            $response);
    }

    public function testGenerateConfirmResponseOKString()
    {
        $response = WirecardCEE_QMore_ReturnFactory::generateConfirmResponseString();
        $this->assertEquals('<QPAY-CONFIRMATION-RESPONSE result="OK" />', $response);
    }

    public function testGenerateConfirmResponseHtmlCommentOKString()
    {
        $response = WirecardCEE_QMore_ReturnFactory::generateConfirmResponseString('', true);
        $this->assertEquals('<!--<QPAY-CONFIRMATION-RESPONSE result="OK" />-->', $response);
    }
}

