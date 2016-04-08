<?php

/**
 * Test class for WirecardCEE_QPay_Response_Toolkit_Order_PaymentTest.
 * Generated by PHPUnit on 2011-06-24 at 13:26:16.
 */
class WirecardCEE_QPay_Response_Toolkit_Order_PaymentTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var WirecardCEE_QPay_Response_Toolkit_Order_Payment
     */
    protected $object;
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = '';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 5472113;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $customerId = $this->_customerId;
        $shopId     = $this->_shopId;
        $secret     = $this->_secret;
        $language   = $this->_language;

        $oToolkitClient = new WirecardCEE_QPay_ToolkitClient(Array(
            'CUSTOMER_ID'      => $customerId,
            'SHOP_ID'          => $shopId,
            'SECRET'           => $secret,
            'LANGUAGE'         => $language,
            'TOOLKIT_PASSWORD' => $this->_toolkitPassword
        ));

        $this->object = $oToolkitClient->getOrderDetails($this->_orderNumber)->getOrder()->getPayments()->current();
    }

    public function testGetMerchantNumber()
    {
        $this->assertEquals(1, $this->object->getMerchantNumber());
    }

    public function testGetPaymentNumber()
    {
        $this->assertEquals('5472113', $this->object->getPaymentNumber());
    }

    public function testGetOrderNumber()
    {
        $this->assertEquals($this->_orderNumber, $this->object->getOrderNumber());
    }

    public function testGetApproveAmount()
    {
        $this->assertEquals('1.00', $this->object->getApproveAmount());
    }

    public function testGetDepositAmount()
    {
        $this->assertEquals('1.00', $this->object->getDepositAmount());
    }

    public function testGetCurrency()
    {
        $this->assertEquals('EUR', $this->object->getCurrency());
    }

    public function testGetTimeCreated()
    {
        $this->assertInstanceOf('DateTime', $this->object->getTimeCreated());
    }

    public function testGetTimeModified()
    {
        $this->assertInstanceOf('DateTime', $this->object->getTimeModified());
    }

    public function testGetState()
    {
        $this->assertEquals('payment_deposited', $this->object->getState());
    }

    public function testGetPaymentType()
    {
        $this->assertEquals('PSC', $this->object->getPaymentType());
    }

    public function testGetOperationsAllowed()
    {
        $this->assertEquals(array(''), $this->object->getOperationsAllowed());
    }

    public function testGetGatewayReferencenumber()
    {
        $this->assertEquals('', $this->object->getGatewayReferencenumber());
    }

    public function testGetAvsResultCode()
    {
        $this->assertEquals('', $this->object->getAvsResultCode());
    }

    public function testGetAvsResultMessage()
    {
        $this->assertEquals('', $this->object->getAvsResultMessage());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = null;
        unset( $this );
    }
}

