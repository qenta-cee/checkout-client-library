<?php

/**
 * Test class for WirecardCEE_Client_QMore_Return_Success_Sofortueberweisung.
 * Generated by PHPUnit on 2011-06-24 at 13:26:03.
 */
class WirecardCEE_QMore_Return_Success_SofortueberweisungTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var WirecardCEE_QMore_Return_Success_Sofortueberweisung
     */
    protected $object;
    protected $_returnData = Array(
        'amount'                   => '1',
        'currency'                 => 'EUR',
        'paymentType'              => 'SOFORTUEBERWEISUNG',
        'financialInstitution'     => 'sofortueberweisung',
        'language'                 => 'de',
        'orderNumber'              => '5717698',
        'paymentState'             => 'SUCCESS',
        'senderAccountOwner'       => 'Jürgen Mustermann',
        'senderAccountNumber'      => '112233',
        'senderBankNumber'         => '88888888',
        'senderBankName'           => 'Testbank',
        'senderBIC'                => 'PNAGDE00000',
        'senderIBAN'               => 'DE35888888880000112233',
        'senderCountry'            => 'DE',
        'securityCriteria'         => '1',
        'gatewayReferenceNumber'   => 'DGW_5717698_RN',
        'gatewayContractNumber'    => 'DemoContractNumber123',
        'avsResponseCode'          => 'X',
        'avsResponseMessage'       => 'Demo AVS ResultMessage',
        'responseFingerprintOrder' => 'amount,currency,paymentType,financialInstitution,language,orderNumber,paymentState,senderAccountOwner,senderAccountNumber,senderBankNumber,senderBankName,senderBIC,senderIBAN,senderCountry,securityCriteria,gatewayReferenceNumber,gatewayContractNumber,avsResponseCode,avsResponseMessage,secret,responseFingerprintOrder',
        'responseFingerprint'      => '36e4a163e1e94017cbffa7ea48614bb3c21426e8e18fecba93aa4411eb409b1dc79bb65f59d448cb488a230741bd1cb8bf2155965e61225578f5c0a56c75bb8f'
    );

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new WirecardCEE_QMore_Return_Success_Sofortueberweisung($this->_returnData, $this->_secret);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testGetSenderAccountOwner()
    {
        $this->assertEquals('Jürgen Mustermann', $this->object->getSenderAccountOwner());
    }

    public function testGetSenderAccountNumber()
    {
        $this->assertEquals('112233', $this->object->getSenderAccountNumber());
    }

    public function testGetSenderBankNumber()
    {
        $this->assertEquals('88888888', $this->object->getSenderBankNumber());
    }

    public function testGetSenderBankName()
    {
        $this->assertEquals('Testbank', $this->object->getSenderBankName());
    }

    public function testGetSenderBic()
    {
        $this->assertEquals('PNAGDE00000', $this->object->getSenderBic());
    }

    public function testGetSenderIban()
    {
        $this->assertEquals('DE35888888880000112233', $this->object->getSenderIban());
    }

    public function testGetSenderCountry()
    {
        $this->assertEquals('DE', $this->object->getSenderCountry());
    }

    public function testGetSecurityCriteria()
    {
        $this->assertEquals('1', $this->object->getSecurityCriteria());
    }

    public function testValidate()
    {
        $this->assertTrue($this->object->validate());
    }
}

?>
