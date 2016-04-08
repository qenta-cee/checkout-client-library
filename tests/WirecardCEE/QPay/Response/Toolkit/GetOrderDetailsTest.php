<?php

/**
 * WirecardCEE_QPay_Response_Toolkit_GetOrderDetailsTest test case.
 */
class WirecardCEE_QPay_Response_Toolkit_GetOrderDetailsTest extends PHPUnit_Framework_TestCase
{
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = '';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 123456;
    protected $object;

    /**
     * Prepares the environment before running a test.
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

        $this->object = $oToolkitClient->getOrderDetails($this->_orderNumber);
    }

    public function testGetStatus()
    {
        $this->assertEquals($this->object->getStatus(), 0);
    }

    public function testGetErrors()
    {
        $this->assertEmpty($this->object->getError());
    }

    public function testGetOrder()
    {
        $order = $this->object->getOrder();
        $this->assertInstanceOf('WirecardCEE_QPay_Response_Toolkit_Order', $order);
    }

    /**
     * Test hasFailed()
     */
    public function testHasFailed()
    {
        $this->assertFalse($this->object->hasFailed());
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

