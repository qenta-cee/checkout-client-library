<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Qenta Payment CEE GmbH
 * (abbreviated to Qenta CEE) and are explicitly not part of the Qenta CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Qenta CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Qenta CEE does not guarantee their full
 * functionality neither does Qenta CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Qenta CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

/**
 * Test class for QentaCEE_Client_QPay_Return_Success_Sofortueberweisung.
 * Generated by PHPUnit on 2011-06-24 at 13:26:03.
 */
use PHPUnit\Framework\TestCase;

class QentaCEE_QPay_Return_Success_SofortueberweisungTest extends TestCase
{

    /**
     * @var QentaCEE_QPay_Return_Success_Sofortueberweisung
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
    protected function setUp(): void
    {
        $this->object = new QentaCEE\QPay\Returns\Success\Sofortueberweisung($this->_returnData, $this->_secret);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
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

