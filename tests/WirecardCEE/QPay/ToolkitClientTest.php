<?php

/**
 * WirecardCEE_QPay_ToolkitClient test case.
 */
class WirecardCEE_QPay_ToolkitClientTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var WirecardCEE_QPay_ToolkitClient
     */
    private $object;
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = '';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_amount = '1.2';
    protected $_currency = 'eur';
    protected $_sourceOrderNumber = '23473341';
    protected $_depositFlag = false;
    protected $_orderDescription = 'Unittest OrderDescr';
    protected $_orderNumber = 123456;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->object = new WirecardCEE_QPay_ToolkitClient(Array(
            'CUSTOMER_ID'      => $this->_customerId,
            'SHOP_ID'          => $this->_shopId,
            'SECRET'           => $this->_secret,
            'LANGUAGE'         => $this->_language,
            'TOOLKIT_PASSWORD' => $this->_toolkitPassword
        ));
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
     * Tests WirecardCEE_QPay_ToolkitClient->refund()
     */
    public function testRefund()
    {
        $oResult = $this->object->refund($this->_orderNumber, $this->_amount, $this->_currency);

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Toolkit_Refund', $oResult);
        $this->assertEquals($oResult->getStatus(), 0);
        $this->assertFalse($oResult->hasFailed());
        $this->assertFalse($oResult->getError());
        $this->assertInternalType('string', $oResult->getCreditNumber());
        $this->assertNotEquals('', $oResult->getCreditNumber());
    }

    /**
     * Tests WirecardCEE_QPay_ToolkitClient->refundReversal()
     */
    public function testRefundReversal()
    {
        $iCreditNumber = 321312;

        $oResult = $this->object->refundReversal($this->_orderNumber, $iCreditNumber);

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Toolkit_RefundReversal', $oResult);
        $this->assertEquals($oResult->getStatus(), 0);
        $this->assertFalse($oResult->hasFailed());
        $this->assertFalse($oResult->getError());

    }

    /**
     * Tests WirecardCEE_QPay_ToolkitClient->recurPayment()
     */
    public function testRecurPayment()
    {
        $_customerId = 'D200050';
        $_shopId     = 'RECUR';

        $object = new WirecardCEE_QPay_ToolkitClient(Array(
            'CUSTOMER_ID'      => $_customerId,
            'SHOP_ID'          => $_shopId,
            'SECRET'           => $this->_secret,
            'LANGUAGE'         => $this->_language,
            'TOOLKIT_PASSWORD' => $this->_toolkitPassword
        ));

        $oResult = $object->recurPayment($this->_sourceOrderNumber, $this->_amount, $this->_currency,
            $this->_orderDescription, $this->_orderNumber, $this->_depositFlag);
        $this->assertInstanceOf('WirecardCEE_QPay_Response_Toolkit_RecurPayment', $oResult);
        $this->assertEquals($oResult->getStatus(), 0);
        $this->assertFalse($oResult->hasFailed());
        $this->assertFalse($oResult->getError());
    }

    /**
     * Tests WirecardCEE_QPay_ToolkitClient->getOrderDetails()
     */
    public function testGetOrderDetails()
    {
        $iOrderNumber = 23473341;
        $oResult      = $this->object->getOrderDetails($iOrderNumber);
        $order        = $oResult->getOrder();
        $sPaymentType = $order->getPaymentType();

        $this->assertEquals('VPG', $sPaymentType);
        $this->assertInstanceOf('WirecardCEE_QPay_Response_Toolkit_Order', $order);
        $this->assertEquals($oResult->getStatus(), 0);
        $this->assertFalse($oResult->hasFailed());
        $this->assertFalse($oResult->getError());
    }

    /**
     * Tests WirecardCEE_QPay_ToolkitClient->approveReversal()
     */
    public function testApproveReversal()
    {
        $oResult = $this->object->approveReversal($this->_orderNumber);

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Toolkit_ApproveReversal', $oResult);
        $this->assertEquals($oResult->getStatus(), 0);
        $this->assertFalse($oResult->hasFailed());
        $this->assertFalse($oResult->getError());
    }

    /**
     * Tests WirecardCEE_QPay_ToolkitClient->deposit()
     */
    public function testDeposit()
    {
        $oResult = $this->object->deposit($this->_orderNumber, $this->_amount, $this->_currency);

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Toolkit_Deposit', $oResult);
        $this->assertEquals($this->_orderNumber, $oResult->getPaymentNumber());
        $this->assertEquals($oResult->getStatus(), 0);
        $this->assertFalse($oResult->hasFailed());
        $this->assertFalse($oResult->getError());
    }

    /**
     * Tests WirecardCEE_QPay_ToolkitClient->depositReversal()
     */
    public function testDepositReversal()
    {
        $_paymentNumber = 123445;
        $oResult        = $this->object->depositReversal($this->_orderNumber, $_paymentNumber);

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Toolkit_DepositReversal', $oResult);
        $this->assertEquals($oResult->getStatus(), 0);
        $this->assertFalse($oResult->hasFailed());
        $this->assertFalse($oResult->getError());
    }

    /**
     * @expectedException WirecardCEE_QPay_Exception_InvalidArgumentException
     */
    public function testCustomerIdIsEmpty()
    {
        $object = new WirecardCEE_QPay_ToolkitClient(Array(
            'CUSTOMER_ID'      => '',
            'SHOP_ID'          => $this->_shopId,
            'SECRET'           => $this->_secret,
            'LANGUAGE'         => $this->_language,
            'TOOLKIT_PASSWORD' => $this->_toolkitPassword
        ));
    }

    /**
     * @expectedException WirecardCEE_QPay_Exception_InvalidArgumentException
     */
    public function testLanguageIsEmpty()
    {
        $object = new WirecardCEE_QPay_ToolkitClient(Array(
            'CUSTOMER_ID'      => $this->_customerId,
            'SHOP_ID'          => $this->_shopId,
            'SECRET'           => $this->_secret,
            'LANGUAGE'         => '',
            'TOOLKIT_PASSWORD' => $this->_toolkitPassword
        ));
    }

    /**
     * @expectedException WirecardCEE_QPay_Exception_InvalidArgumentException
     */
    public function testSecretIsEmpty()
    {
        $object = new WirecardCEE_QPay_ToolkitClient(Array(
            'CUSTOMER_ID'      => $this->_customerId,
            'SHOP_ID'          => $this->_shopId,
            'SECRET'           => '',
            'LANGUAGE'         => $this->_language,
            'TOOLKIT_PASSWORD' => $this->_toolkitPassword
        ));
    }

    /**
     * @expectedException WirecardCEE_QPay_Exception_InvalidArgumentException
     */
    public function testToolkitPasswordIsEmpty()
    {
        $object = new WirecardCEE_QPay_ToolkitClient(Array(
            'CUSTOMER_ID'      => $this->_customerId,
            'SHOP_ID'          => $this->_shopId,
            'SECRET'           => $this->_secret,
            'LANGUAGE'         => $this->_language,
            'TOOLKIT_PASSWORD' => ''
        ));
    }

    public function testConfigFallback()
    {
        $object      = new WirecardCEE_QPay_ToolkitClient();
        $oUserConfig = $object->getUserConfig();
        $this->assertInstanceOf('WirecardCEE_Stdlib_Config', $oUserConfig);
        $this->assertEquals($oUserConfig->CUSTOMER_ID, 'D200001');
    }

}

