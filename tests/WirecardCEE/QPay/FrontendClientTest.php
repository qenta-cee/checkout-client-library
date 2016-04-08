<?php
/*
 * Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig. Software & Service Copyright (C) by Wirecard Central Eastern
* Europe GmbH, FB-Nr: FN 195599 x, http://<setthis>/tests/confirm.php
*/

/**
 * WirecardCEE_QPayFrontendClient test case.
 */
class WirecardCEE_QPay_FrontendClientTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @var array
     */
    protected $aUserConfig;

    /**
     *
     * @var array
     */
    protected $aClientConfig;

    /**
     *
     * @var WirecardCEE_QPay_FrontendClient
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object        = new WirecardCEE_QPay_FrontendClient();
        $this->aUserConfig   = WirecardCEE_QPay_Module::getConfig();
        $this->aClientConfig = WirecardCEE_QPay_Module::getClientConfig();
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
        $this->object = new WirecardCEE_QPay_FrontendClient($aConfig);
        $this->assertEquals($this->aUserConfig['WirecardCEEQPayConfig']['CUSTOMER_ID'],
            $this->object->getUserConfig()->get('CUSTOMER_ID'));
        $this->assertEquals($this->aUserConfig['WirecardCEEQPayConfig']['SHOP_ID'],
            $this->object->getUserConfig()->get('SHOP_ID'));
        $this->assertEquals($this->aUserConfig['WirecardCEEQPayConfig']['LANGUAGE'],
            $this->object->getUserConfig()->get('LANGUAGE'));
        $this->assertEquals($this->aUserConfig['WirecardCEEQPayConfig']['SECRET'],
            $this->object->getUserConfig()->get('SECRET'));
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->setConfirmUrl()
     */
    public function testSetConfirmUrl()
    {
        $confirmUrl = 'http://<setthis>/tests/confirm.php';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl($confirmUrl)
                                  ->setConsumerData($consumerData)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertFalse($oResponse->hasFailed());
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->getError());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->setWindowName()
     */
    public function testSetWindowName()
    {
        $windowName = 'phpUnitWindow';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setWindowName($windowName)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertFalse($oResponse->hasFailed());
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->getError());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->setDuplicateRequestCheck()
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
                                           ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                           ->setOrderDescription(__METHOD__)
                                           ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                           ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                           ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                           ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                           ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                           ->setConsumerData($consumerData)
                                           ->setDuplicateRequestCheck($duplicateRequestCheck)
                                           ->initiate();

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertFalse($oResponse->hasFailed());
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->getError());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->setCustomerStatement()
     */
    public function testSetCustomerStatement()
    {
        $customerStatement = 'cStatement';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setCustomerStatement($customerStatement)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->hasFailed());
        $this->assertFalse($oResponse->getError());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->setOrderReference()
     */
    public function testSetOrderReference()
    {
        $orderReference = '123333';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setOrderReference($orderReference)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->hasFailed());
        $this->assertFalse($oResponse->getError());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->setAutoDeposit()
     */
    public function testSetAutoDeposit()
    {
        $autoDeposit = true;

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setAutoDeposit($autoDeposit)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->hasFailed());
        $this->assertFalse($oResponse->getError());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->setMaxRetries()
     */
    public function testSetMaxRetries()
    {
        $maxRetries = '12';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setMaxRetries($maxRetries)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->hasFailed());
        $this->assertFalse($oResponse->getError());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());

    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->setMaxRetries()
     */
    public function testSetOrderNumber()
    {
        $orderNumber = '123321';
        $maxRetries  = 0;
        $sUrl        = 'http://<setthis>/tests/confirm.php';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl($sUrl)
                                  ->setCancelUrl($sUrl)
                                  ->setFailureUrl($sUrl)
                                  ->setServiceUrl($sUrl)
                                  ->setConfirmUrl($sUrl)
                                  ->setConsumerData($consumerData)
                                  ->setOrderNumber($orderNumber)
                                  ->setMaxRetries($maxRetries)
                                  ->initiate();


        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertFalse($oResponse->getError());
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->hasFailed());
        //$this->assertFalse($oResponse->getError());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->setConfirmMail()
     */
    public function testSetConfirmMail()
    {
        $confirmMail = 'ante.drnasin@wirecard.at';

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setConfirmMail($confirmMail)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->hasFailed());
        $this->assertFalse($oResponse->getError());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->initiate()
     */
    public function testInitiate()
    {
        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->getError());
        $this->assertFalse($oResponse->hasFailed());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * @expectedException WirecardCEE_Stdlib_Exception_InvalidResponseException
     */
    public function testClientFailedResponse()
    {
        $oResponse = new WirecardCEE_QPay_Response_Initiation(new stdClass());
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->__construct()
     *
     * @dataProvider provider
     * @expectedException WirecardCEE_QPay_Exception_InvalidArgumentException
     *
     * @param string $aConfig
     */
    public function testMissingConfigValueInConfigArray($aConfig)
    {
        $aConfig['WirecardCEEQPayConfig']['CUSTOMER_ID'] = null;
        $this->object                                    = new WirecardCEE_QPay_FrontendClient($aConfig);

    }

    /**
     *
     * @expectedException WirecardCEE_QPay_Exception_InvalidArgumentException
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
     * Tests WirecardCEE_QPay_FrontendClient->getResponse()
     */
    public function testGetResponse()
    {
        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress('10.1.0.11');
        $consumerData->setUserAgent('phpUnit');

        $oResponse = $this->object->setAmount(100)
                                  ->setCurrency('eur')
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->initiate();

        $oResponse = $this->object->getResponse();

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->getError());
        $this->assertFalse($oResponse->hasFailed());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    /**
     * @expectedException Exception
     */
    public function testConstructorWithInvalidParam()
    {
        $this->object = null;

        try {
            $this->object = new WirecardCEE_QPay_FrontendClient(array());
        } catch (Exception $e) {
            $this->assertStringStartsWith('CUSTOMER_ID passed', $e->getMessage());
            throw $e;
        }
    }

    /**
     * @dataProvider provider
     * @expectedException WirecardCEE_QPay_Exception_InvalidArgumentException
     */
    public function testConstructorWhenLanguageParamIsEmpty($aConfig)
    {
        $aConfig['WirecardCEEQPayConfig']['LANGUAGE'] = null;

        try {
            $this->object = new WirecardCEE_QPay_FrontendClient($aConfig);
        } catch (WirecardCEE_QPay_Exception_InvalidArgumentException $e) {
            $this->assertStringStartsWith('LANGUAGE passed to', $e->getMessage());
            throw $e;
        }
    }

    /**
     * @dataProvider provider
     * @expectedException WirecardCEE_QPay_Exception_InvalidArgumentException
     */
    public function testConstructorWhenSecretParamIsEmpty($aConfig)
    {
        $aConfig['WirecardCEEQPayConfig']['SECRET'] = null;

        try {
            $this->object = new WirecardCEE_QPay_FrontendClient($aConfig);
        } catch (WirecardCEE_QPay_Exception_InvalidArgumentException $e) {
            $this->assertStringStartsWith('SECRET passed to', $e->getMessage());
            throw $e;
        }
    }

    /**
     * Tests WirecardCEE_QPay_FrontendClient->getResponse()
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
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::PAYPAL)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setPluginVersion($sPluginVersion)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->getError());
        $this->assertFalse($oResponse->hasFailed());
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
                                  ->setPaymentType(WirecardCEE_QPay_PaymentType::EPS)
                                  ->setFinancialInstitution($sFinancialInstitution)
                                  ->setOrderDescription(__METHOD__)
                                  ->setSuccessUrl('http://<setthis>/tests/confirm.php')
                                  ->setCancelUrl('http://<setthis>/tests/confirm.php')
                                  ->setFailureUrl('http://<setthis>/tests/confirm.php')
                                  ->setServiceUrl('http://<setthis>/tests/confirm.php')
                                  ->setConfirmUrl('http://<setthis>/tests/confirm.php')
                                  ->setConsumerData($consumerData)
                                  ->setFinancialInstitution($sFinancialInstitution)
                                  ->initiate();

        $this->assertInstanceOf('WirecardCEE_QPay_Response_Initiation', $oResponse);
        $this->assertEquals($oResponse->getStatus(), 0);
        $this->assertFalse($oResponse->getError());
        $this->assertFalse($oResponse->hasFailed());
        $this->assertStringStartsWith('https://', $oResponse->getRedirectUrl());
    }

    public function testDisplayTextAndImageUrl()
    {
        $this->object->setDisplayText('display text')->setImageUrl('https://www.google.com/intl/en_ALL/images/logos/images_logo_lg.gif');
    }


    public function provider()
    {
        return Array(
            Array(
                Array(
                    'WirecardCEEQPayConfig' => Array(
                        'CUSTOMER_ID' => 'D200001',
                        'SHOP_ID'     => '',
                        'SECRET'      => 'B8AKTPWBRMNBV455FG6M2DANE99WU2',
                        'LANGUAGE'    => 'en'
                    )
                )
            )
        );
    }

}
