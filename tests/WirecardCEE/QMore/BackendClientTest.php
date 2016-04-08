<?php

class WirecardCEE_QMore_BackendClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $aUserConfig;

    /**
     * @var array
     */
    protected $aClientConfig;

    /**
     *
     * @var WirecardCEE_QMore_BackendClient
     */
    protected $object;


    public function setUp()
    {
        $this->object        = new WirecardCEE_QMore_BackendClient();
        $this->aUserConfig   = WirecardCEE_QMore_Module::getConfig();
        $this->aClientConfig = WirecardCEE_QMore_Module::getClientConfig();
    }

    /**
     * @dataProvider _provider
     */
    public function testConstructorArrayParam($aConfig)
    {
        $this->assertEquals($this->aUserConfig['WirecardCEEQMoreConfig']['CUSTOMER_ID'],
            $this->object->getUserConfig()->CUSTOMER_ID);
        $this->assertEquals($this->aUserConfig['WirecardCEEQMoreConfig']['SHOP_ID'],
            $this->object->getUserConfig()->SHOP_ID);
        $this->assertEquals($this->aUserConfig['WirecardCEEQMoreConfig']['LANGUAGE'],
            $this->object->getUserConfig()->LANGUAGE);
        $this->assertEquals($this->aUserConfig['WirecardCEEQMoreConfig']['SECRET'],
            $this->object->getUserConfig()->SECRET);
        $this->assertEquals($this->aUserConfig['WirecardCEEQMoreConfig']['PASSWORD'],
            $this->object->getUserConfig()->PASSWORD);
    }

    /**
     * @expectedException Exception
     */
    public function testConstructorWithInvalidParam()
    {
        $this->object = null;

        try {
            $this->object = new WirecardCEE_QMore_BackendClient(array());
        } catch (Exception $e) {
            $this->assertStringStartsWith('CUSTOMER_ID passed', $e->getMessage());
            throw $e;
        }
    }

    /**
     * @dataProvider _provider
     * @expectedException WirecardCEE_QMore_Exception_InvalidArgumentException
     */
    public function testConstructorWhenLanguageParamIsEmpty($aConfig)
    {
        $aConfig['WirecardCEEQMoreConfig']['LANGUAGE'] = null;

        try {
            $this->object = new WirecardCEE_QMore_BackendClient($aConfig);
        } catch (WirecardCEE_QMore_Exception_InvalidArgumentException $e) {
            $this->assertStringStartsWith('LANGUAGE passed to', $e->getMessage());
            throw $e;
        }
    }

    /**
     * @dataProvider _provider
     * @expectedException WirecardCEE_QMore_Exception_InvalidArgumentException
     */
    public function testConstructorWhenCustomerIdParamIsEmpty($aConfig)
    {
        $aConfig['WirecardCEEQMoreConfig']['CUSTOMER_ID'] = null;

        try {
            $this->object = new WirecardCEE_QMore_BackendClient($aConfig);
        } catch (WirecardCEE_QMore_Exception_InvalidArgumentException $e) {
            $this->assertStringStartsWith('CUSTOMER_ID passed to', $e->getMessage());
            throw $e;
        }
    }

    /**
     * @dataProvider _provider
     * @expectedException WirecardCEE_QMore_Exception_InvalidArgumentException
     */
    public function testConstructorWhenSecretParamIsEmpty($aConfig)
    {
        $aConfig['WirecardCEEQMoreConfig']['SECRET'] = null;

        try {
            $this->object = new WirecardCEE_QMore_BackendClient($aConfig);
        } catch (WirecardCEE_QMore_Exception_InvalidArgumentException $e) {
            $this->assertStringStartsWith('SECRET passed to', $e->getMessage());
            throw $e;
        }
    }

    /**
     * @dataProvider _provider
     * @expectedException WirecardCEE_QMore_Exception_InvalidArgumentException
     */
    public function testConstructorWhenPasswordParamIsEmpty($aConfig)
    {
        $aConfig['WirecardCEEQMoreConfig']['PASSWORD'] = null;

        try {
            $this->object = new WirecardCEE_QMore_BackendClient($aConfig);
        } catch (WirecardCEE_QMore_Exception_InvalidArgumentException $e) {
            $this->assertStringStartsWith('PASSWORD passed to', $e->getMessage());
            throw $e;
        }
    }

    public function testRefund()
    {
        $oResponse = $this->object->refund(123456, '1.2', 'USD');
        $this->assertInstanceOf('WirecardCEE_QMore_Response_Backend_Refund', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertInternalType('string', $oResponse->getCreditNumber());
        $this->assertNotEquals('', $oResponse->getCreditNumber());
        $this->assertFalse($oResponse->hasFailed());
    }

    public function testRefundReversal()
    {
        $oResponse = $this->object->refundReversal(123456, 321312);
        $this->assertInstanceOf('WirecardCEE_QMore_Response_Backend_RefundReversal', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertFalse($oResponse->hasFailed());
    }

    public function testRecurPayment()
    {
        $pluginVersion = WirecardCEE_QMore_FrontendClient::generatePluginVersion('InitiationTest', '0.0.0',
            'defaultInstance', '0.0.0');
        $object        = new WirecardCEE_QMore_BackendClient(
            Array(
                'WirecardCEEQMoreConfig' => Array(
                    'CUSTOMER_ID' => 'D200050',
                    'SHOP_ID'     => 'RECUR',
                    'SECRET'      => 'B8AKTPWBRMNBV455FG6M2DANE99WU2',
                    'LANGUAGE'    => 'en',
                    'PASSWORD'    => 'jcv45z'
                )
            ));
        $oResponse     = $object->recurPayment('23473341', '1,2', 'EUR', __METHOD__, '', false);
        $this->assertInstanceOf('WirecardCEE_QMore_Response_Backend_RecurPayment', $oResponse);
        $this->assertNotEquals('', $oResponse->getOrderNumber());
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertFalse($oResponse->hasFailed());
    }


    public function testGetOrderDetails()
    {
        $oResponse = $this->object->getOrderDetails(123456);
        $this->assertInstanceOf('WirecardCEE_QMore_Response_Backend_GetOrderDetails', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertFalse($oResponse->hasFailed());

        $order = $oResponse->getOrder();
        $this->assertInstanceOf('WirecardCEE_QMore_Response_Backend_Order', $order);
    }

    public function testApproveReversal()
    {
        $oResponse = $this->object->approveReversal(123456);
        $this->assertInstanceOf('WirecardCEE_QMore_Response_Backend_ApproveReversal', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertFalse($oResponse->hasFailed());
    }

    public function testDeposit()
    {
        $oResponse = $this->object->deposit(123456, 100, 'eur');
        $this->assertInstanceOf('WirecardCEE_QMore_Response_Backend_Deposit', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertFalse($oResponse->hasFailed());
        $this->assertEquals(123456, $oResponse->getPaymentNumber());

    }

    public function testDepositReversal()
    {
        $oResponse = $this->object->depositReversal(123456, 123445);
        $this->assertInstanceOf('WirecardCEE_QMore_Response_Backend_DepositReversal', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertFalse($oResponse->hasFailed());
    }

    public function _provider()
    {
        return Array(
            Array(
                Array(
                    'WirecardCEEQMoreConfig' => Array(
                        'CUSTOMER_ID' => 'D200001',
                        'SHOP_ID'     => 'qmore',
                        'SECRET'      => 'B8AKTPWBRMNBV455FG6M2DANE99WU2',
                        'LANGUAGE'    => 'en',
                        'PASSWORD'    => 'jcv45z'
                    )
                )
            )
        );
    }

}