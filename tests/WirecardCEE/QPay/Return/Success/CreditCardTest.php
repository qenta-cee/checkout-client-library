<?php

/**
 * Test class for WirecardCEE_Client_QPay_Return_Success_Creditcard.
 * Generated by PHPUnit on 2011-06-24 at 13:36:02.
 */
class WirecardCEE_QPay_Return_Success_CreditcardTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var WirecardCEE_QPay_Return_Success_Creditcard
     */
    protected $object;

    protected $_returnData = Array(
        'amount'                   => '1',
        'currency'                 => 'EUR',
        'paymentType'              => 'CCARD',
        'financialInstitution'     => 'MC',
        'language'                 => 'de',
        'orderNumber'              => '16375141',
        'paymentState'             => 'SUCCESS',
        'authenticated'            => 'Yes',
        'anonymousPan'             => '0001',
        'expiry'                   => '10/2012',
        'cardholder'               => 'keiner',
        'maskedPan'                => '950000******0001',
        'gatewayReferenceNumber'   => 'DGW_16375141_RN',
        'gatewayContractNumber'    => 'DemoContractNumber123',
        'avsResponseCode'          => 'X',
        'avsResponseMessage'       => 'Demo AVS ResultMessage',
        'responseFingerprintOrder' => 'amount,currency,paymentType,financialInstitution,language,orderNumber,paymentState,authenticated,anonymousPan,expiry,cardholder,maskedPan,gatewayReferenceNumber,gatewayContractNumber,avsResponseCode,avsResponseMessage,secret,responseFingerprintOrder',
        'responseFingerprint'      => 'e077f1e8488f06a444899b43c94a0c814c69efea4870b4afc931cacc99ee1516db3f5909f7079d657d73fe0ef92c4cc48515cd4026168d228962ba7d05cc503f'
    );

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new WirecardCEE_QPay_Return_Success_CreditCard($this->_returnData, $this->_secret);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testGetAnonymousPan()
    {
        $this->assertEquals('0001', $this->object->getAnonymousPan());
    }

    public function testGetAuthenticated()
    {
        $this->assertEquals('Yes', $this->object->getAuthenticated());
    }

    public function testGetExpiry()
    {
        $this->assertEquals('10/2012', $this->object->getExpiry());
    }

    public function testGetCardholder()
    {
        $this->assertEquals('keiner', $this->object->getCardholder());
    }

    public function testGetMaskedPan()
    {
        $this->assertEquals('950000******0001', $this->object->getMaskedPan());
    }

    public function testValidate()
    {
        $this->assertTrue($this->object->validate());
    }
}

