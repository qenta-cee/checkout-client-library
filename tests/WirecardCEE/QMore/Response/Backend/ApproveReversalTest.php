<?php

/**
 * WirecardCEE_QMore_Response_Backend_ApproveReversal test case.
 */
class WirecardCEE_QMore_Response_Backend_ApproveReversalTest extends PHPUnit_Framework_TestCase
{

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = 'qmore';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 123456;

    /**
     *
     * @var WirecardCEE_QMore_Response_Backend_ApproveReversal
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
            'PASSWORD'    => $this->_toolkitPassword
        ));

        $this->object = $oBackClient->approveReversal($this->_orderNumber);
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
        // WirecardCEE_QMore_Response_Backend_ApproveReversalTest::tearDown()
        $this->object = null;

        parent::tearDown();
    }
}

