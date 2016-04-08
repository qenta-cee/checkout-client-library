<?php

/**
 * WirecardCEE_QMore_Response_Backend_Refund test case.
 */
class WirecardCEE_QMore_Response_Backend_RefundTest extends PHPUnit_Framework_TestCase
{

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = 'qmore';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 123456;
    protected $_amount = '1.2';
    protected $_currency = 'USD';

    /**
     *
     * @var WirecardCEE_QMore_Response_Backend_Refund
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

        $oBackClient  = new WirecardCEE_QMore_BackendClient();
        $this->object = $oBackClient->refund($this->_orderNumber, $this->_amount, $this->_currency);
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
        $this->assertEmpty($this->object->getErrors());
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
    public function testHasFailed()
    {
        $this->assertFalse($this->object->hasFailed());
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated
        // WirecardCEE_QMore_Response_Backend_RefundTest::tearDown()
        $this->object = null;

        parent::tearDown();
    }
}

