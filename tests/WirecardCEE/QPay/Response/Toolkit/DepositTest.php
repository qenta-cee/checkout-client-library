<?php

/**
 * WirecardCEE_QPay_Response_Toolkit_DepositTest test case.
 */
class WirecardCEE_QPay_Response_Toolkit_DepositTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @var WirecardCEE_QPay_Response_Toolkit_Deposit
     */
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = '';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 123456;

    /**
     *
     * @var WirecardCEE_QPay_Response_Toolkit_Deposit
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

        $this->object = $oToolkitClient->deposit($this->_orderNumber, 100, 'eur');
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
     * Test hasFailed()
     */
    public function testHasFailed()
    {
        $this->assertFalse($this->object->hasFailed());
    }

    public function testGetPaymentNumber()
    {
        $this->assertEquals($this->_orderNumber, $this->object->getPaymentNumber());
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

