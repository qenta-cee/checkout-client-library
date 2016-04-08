<?php
/*
 * Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig. Software & Service Copyright (C) by Wirecard Central Eastern
* Europe GmbH, FB-Nr: FN 195599 x, http://wireacrd.at
*/

/**
 * WirecardCEE_QMore_FrontendClient test case.
 */
class WirecardCEE_QMore_FrontendClientTest extends PHPUnit_Framework_TestCase
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
     * @var WirecardCEE_QMore_FrontendClient
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object        = new WirecardCEE_QMore_FrontendClient();
        $this->aUserConfig   = WirecardCEE_QMore_Module::getConfig();
        $this->aClientConfig = WirecardCEE_QMore_Module::getClientConfig();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->object        = null;
        $this->aUserConfig   = null;
        $this->aClientConfig = null;
        unset( $this );
        parent::tearDown();
    }

    /**
     * @dataProvider provider
     */
    public function testConstructorArrayParam($aConfig)
    {
        $this->object = new WirecardCEE_QMore_FrontendClient($aConfig);
        $this->assertEquals($this->aUserConfig['WirecardCEEQMoreConfig']['CUSTOMER_ID'],
            $this->object->getUserConfig()->CUSTOMER_ID);
        $this->assertEquals($this->aUserConfig['WirecardCEEQMoreConfig']['SHOP_ID'],
            $this->object->getUserConfig()->SHOP_ID);
        $this->assertEquals($this->aUserConfig['WirecardCEEQMoreConfig']['LANGUAGE'],
            $this->object->getUserConfig()->LANGUAGE);
        $this->assertEquals($this->aUserConfig['WirecardCEEQMoreConfig']['SECRET'],
            $this->object->getUserConfig()->SECRET);
    }


    /**
     * Tests WirecardCEE_QMore_FrontendClient->setConfirmUrl()
     */
    public function testSetConfirmUrl()
    {
        $confirmUrl = 'http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl($confirmUrl)
                                  ->setConsumerData($consumerData)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->setConfirmUrl()
     */
    public function testSetPendingUrl()
    {
        $confirmUrl = 'http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php';
        $pendingUrl = 'http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/pending.php';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl($confirmUrl)
                                  ->setPendingUrl($pendingUrl)
                                  ->setConsumerData($consumerData)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }


    /**
     * Tests WirecardCEE_QMore_FrontendClient->setWindowName()
     */
    public function testSetWindowName()
    {
        $windowName = 'window';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setWindowName($windowName)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->setDuplicateRequestCheck()
     */
    public function testSetDuplicateRequestCheck()
    {
        $duplicateRequestCheck = true;

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $this->object->rand = rand(0, 9999);
        $oResponse          = $this->object->setAmount(100)
                                           ->setCurrency('eur')
                                           ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                           ->setOrderDescription(__METHOD__)
                                           ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                           ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                           ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                           ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                           ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                           ->setConsumerData($consumerData)
                                           ->setDuplicateRequestCheck($duplicateRequestCheck)
                                           ->initiate();

        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->setCustomerStatement()
     */
    public function testSetCustomerStatement()
    {
        $customerStatement = 'cStatement';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setCustomerStatement($customerStatement)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->setOrderReference()
     */
    public function testSetOrderReference()
    {
        $orderReference = '123333';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setOrderReference($orderReference)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->setAutoDeposit()
     */
    public function testSetAutoDeposit()
    {
        $autoDeposit = true;

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setAutoDeposit($autoDeposit)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->setMaxRetries()
     */
    public function testSetOrderNumber()
    {
        $orderNumber = '123321';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setOrderNumber($orderNumber)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->setConfirmMail()
     */
    public function testSetConfirmMail()
    {
        $confirmMail = 'ante.drnasin@wirecard.at';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setConfirmMail($confirmMail)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->initiate()
     */
    public function testInitiate()
    {
        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertFalse($oResponse->hasFailed());
        $this->assertEquals($oResponse->getNumberOfErrors(), 0);
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * @expectedException WirecardCEE_Stdlib_Exception_InvalidResponseException
     */
    public function testClientFailedResponse()
    {
        try {
            $oResponse = new WirecardCEE_QMore_Response_Initiation(new stdClass());
        } catch (WirecardCEE_Stdlib_Exception_InvalidResponseException $e) {
            throw $e;
        }
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->setStorageReference($sOrderIdent, $sStorageId)
     */
    public function testSetStorageReference()
    {
        $sStorageId  = '10763469b2b8049f6619c914e57faa19';
        $sOrderIdent = 'phpUnit test';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setStorageReference($sOrderIdent, $sStorageId)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->__construct()
     *
     * @dataProvider provider
     * @expectedException WirecardCEE_QMore_Exception_InvalidArgumentException
     *
     * @param string $aConfig
     */
    public function testMissingConfigValueInConfigArray($aConfig)
    {
        $aConfig['WirecardCEEQMoreConfig']['CUSTOMER_ID'] = null;
        $this->object                                     = new WirecardCEE_QMore_FrontendClient($aConfig);
    }

    /**
     *
     * @expectedException WirecardCEE_QMore_Exception_InvalidArgumentException
     */
    public function testFailedInitiate()
    {
        $oResponse = $this->object->initiate();
    }

    /**
     * @expectedException Exception
     */
    public function testGetReponseBeforeInitialize()
    {
        $oResponse = $this->object->getResponse();
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->getResponse()
     */
    public function testGetResponse()
    {
        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->initiate();

        $oResponse = $this->object->getResponse();

        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * @expectedException Exception
     */
    public function testConstructorWithInvalidParam()
    {
        $this->object = null;
        try {
            $this->object = new WirecardCEE_QMore_FrontendClient(array());
        } catch (Exception $e) {
            $this->assertStringStartsWith('CUSTOMER_ID passed', $e->getMessage());
            throw $e;
        }
    }

    /**
     * @dataProvider provider
     * @expectedException WirecardCEE_QMore_Exception_InvalidArgumentException
     */
    public function testConstructorWhenLanguageParamIsEmpty($aConfig)
    {
        $aConfig['WirecardCEEQMoreConfig']['LANGUAGE'] = null;

        try {
            $this->object = new WirecardCEE_QMore_FrontendClient($aConfig);
        } catch (WirecardCEE_QMore_Exception_InvalidArgumentException $e) {
            $this->assertStringStartsWith('LANGUAGE passed to', $e->getMessage());
            throw $e;
        }
    }

    /**
     * @dataProvider provider
     * @expectedException WirecardCEE_QMore_Exception_InvalidArgumentException
     */
    public function testConstructorWhenSecretParamIsEmpty($aConfig)
    {
        $aConfig['WirecardCEEQMoreConfig']['SECRET'] = null;

        try {
            $this->object = new WirecardCEE_QMore_FrontendClient($aConfig);
        } catch (WirecardCEE_QMore_Exception_InvalidArgumentException $e) {
            $this->assertStringStartsWith('SECRET passed to', $e->getMessage());
            throw $e;
        }
    }

    /**
     * Tests WirecardCEE_QMore_FrontendClient->getResponse()
     */
    public function testSetPluginVersion()
    {
        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $sPluginVersion = $this->object->generatePluginVersion('phpunit', '1.0.0', 'phpunit', '1.0.0',
            Array('phpunit' => '3.5.15'));

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setPluginVersion($sPluginVersion)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    public function testSetFinancialInstitution()
    {
        $sPaymentType          = 'EPS';
        $sFinancialInstitution = 'BA-CA';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('EUR')
                                  ->setPaymentType(WirecardCEE_QMore_PaymentType::EPS)
                                  ->setFinancialInstitution($sFinancialInstitution)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setCancelUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setFailureUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setServiceUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConfirmUrl('http://rhswinws64.wirecardcee.lan/PHP_Client_Library/Tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setFinancialInstitution($sFinancialInstitution)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QMore_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertEmpty($oResponse->getErrors());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    public function provider()
    {
        return Array(
            Array(
                Array(
                    'WirecardCEEQMoreConfig' => Array(
                        'CUSTOMER_ID' => 'D200001',
                        'SHOP_ID'     => 'qmore',
                        'SECRET'      => 'B8AKTPWBRMNBV455FG6M2DANE99WU2',
                        'LANGUAGE'    => 'en'
                    )
                )
            )
        );
    }

}

