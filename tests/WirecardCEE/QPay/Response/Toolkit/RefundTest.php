<?php

/**
 * object test case.
 */
class WirecardCEE_QPay_Response_Toolkit_RefundTest extends PHPUnit_Framework_TestCase
{
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = '';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 123456;
    protected $_amount = '1.2';
    protected $_currency = 'USD';

    /**
     * @var WirecardCEE_QPay_Response_Toolkit_Refund
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

        $oToolkitClient = new WirecardCEE_QPay_ToolkitClient(Array(
            'CUSTOMER_ID'      => $customerId,
            'SHOP_ID'          => $shopId,
            'SECRET'           => $secret,
            'LANGUAGE'         => $language,
            'TOOLKIT_PASSWORD' => $toolkitPassword
        ));

        $this->object = $oToolkitClient->refund($this->_orderNumber, $this->_amount, $this->_currency);
    }

    /**
     * Test getStatus()
     */
    public function testGetStatus()
    {
        $this->assertEquals($this->object->getStatus(), 0);
    }

    /**
     * Test getErrors()
     */
    public function testGetErrors()
    {
        $this->assertEmpty($this->object->getError());
    }

    /**
     * Test getCreditNumber()
     */
    public function testGetCreditNumber()
    {
        $this->assertInternalType('string', $this->object->getCreditNumber());
        $this->assertNotEquals('', $this->object->getCreditNumber());
    }

    /**
     * Test hasFailed()
     */
    public function testHasNotFailed()
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

