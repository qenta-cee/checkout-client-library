<?php

/**
 * WirecardCEE_QMore_Response_Backend_Order test case.
 */
class WirecardCEE_QMore_Response_Backend_OrderTest1 extends PHPUnit_Framework_TestCase
{

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = 'qmore';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 1453243;

    /**
     *
     * @var WirecardCEE_QMore_Response_Backend_Order
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $customerId      = $this->_customerId;
        $shopId          = $this->_shopId;
        $secret          = $this->_secret;
        $language        = $this->_language;
        $toolkitPassword = $this->_toolkitPassword;

        $oBackClient = new WirecardCEE_QMore_BackendClient(Array(
            'CUSTOMER_ID' => $customerId,
            'SHOP_ID'     => $shopId,
            'SECRET'      => $secret,
            'LANGUAGE'    => $language,
            'PASSWORD'    => $toolkitPassword
        ));

        $this->object = $oBackClient->getOrderDetails($this->_orderNumber)->getOrder();
    }

    public function testGetMerchantNumber()
    {
        $this->assertEquals(1, $this->object->getMerchantNumber());
    }

    public function testGetOrderNumber()
    {
        $this->assertEquals($this->_orderNumber, $this->object->getOrderNumber());
    }

    public function testGetPaymentType()
    {
        $this->assertEquals('SCM', $this->object->getPaymentType());
    }

    public function testGetAmount()
    {
        $this->assertEquals('1.00', $this->object->getAmount());
    }

    public function testGetBrand()
    {
        $this->assertEquals('Maestro', $this->object->getBrand());
    }

    public function testGetCurrency()
    {
        $this->assertEquals('EUR', $this->object->getCurrency());
    }

    public function testGetOrderDescription()
    {
        $this->assertEquals('Banko Maestro, K-Nr: 453213', $this->object->getOrderDescription());
    }

    public function testGetAcquirer()
    {
        $this->assertEquals('PayLife', $this->object->getAcquirer());
    }

    public function testGetContractNumber()
    {
        $this->assertEquals('0815DemoContract', $this->object->getContractNumber());
    }

    public function testGetOperationsAllowed()
    {
        $this->assertEquals(Array('REFUND'), $this->object->getOperationsAllowed());
    }

    public function testGetOrderReference()
    {
        $this->assertEquals('OR-1453243', $this->object->getOrderReference());
    }

    public function testGetCustomerStatement()
    {
        $this->assertEquals('Danke für den Einkauf!', $this->object->getCustomerStatement());
    }

    public function testGetOrderText()
    {
        $this->assertEquals('', $this->object->getOrderText());
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
        $this->assertEquals('REFUNDABLE', $this->object->getState());
    }

    public function testGetSourceOrderNumber()
    {
        $this->assertEquals('', $this->object->getSourceOrderNumber());
    }

    public function testGetPayments()
    {
        $payments = $this->object->getPayments();
        $this->assertTrue($payments->valid());
        $payments->next();
        $this->assertFalse($payments->valid());
    }

    public function testGetCredits()
    {
        $credits = $this->object->getCredits();
        $this->assertFalse($credits->valid());
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->object = null;

        parent::tearDown();
    }
}

