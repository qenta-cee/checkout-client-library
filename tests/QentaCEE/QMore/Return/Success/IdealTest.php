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
 * Test class for QentaCEE_Client_QMore_Return_Success_Ideal.
 * Generated by PHPUnit on 2011-06-24 at 13:26:06.
 */
use PHPUnit\Framework\TestCase;

class QentaCEE_QMore_Return_Success_IdealTest extends TestCase
{

    /**
     * @var QentaCEE_QMore_Return_Success_Ideal
     */
    protected $object;
    protected $_returnData = Array(
        'amount'                     => '1',
        'currency'                   => 'EUR',
        'paymentType'                => 'IDL',
        'financialInstitution'       => 'INGBANK',
        'language'                   => 'de',
        'orderNumber'                => '7885625',
        'paymentState'               => 'SUCCESS',
        'idealConsumerName'          => 'Test Cönsümer Utløpsdato',
        'idealConsumerCity'          => 'Den Haag',
        'idealConsumerAccountNumber' => 'P001234567',
        'gatewayReferenceNumber'     => 'DGW_7885625_RN',
        'gatewayContractNumber'      => 'DemoContractNumber123',
        'avsResponseCode'            => 'X',
        'avsResponseMessage'         => 'Demo AVS ResultMessage',
        'responseFingerprintOrder'   => 'amount,currency,paymentType,financialInstitution,language,orderNumber,paymentState,idealConsumerName,idealConsumerCity,idealConsumerAccountNumber,gatewayReferenceNumber,gatewayContractNumber,avsResponseCode,avsResponseMessage,secret,responseFingerprintOrder',
        'responseFingerprint'        => 'fc5386502aef8e6b23efaa204e0d84929f818f6ba9914ae6421ac175be3d1efeb2a6687a5e0546c906037837e41d06badb58e1bea9b1d1f72e85db4c581621c1'
    );

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new QentaCEE\QMore\Returns\Success\Ideal($this->_returnData, $this->_secret);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {

    }

    public function testGetConsumerName()
    {
        $this->assertEquals('Test Cönsümer Utløpsdato', $this->object->getConsumerName());
    }

    public function testGetConsumerCity()
    {
        $this->assertEquals('Den Haag', $this->object->getConsumerCity());
    }

    public function testGetConsumerAccountNumber()
    {
        $this->assertEquals('P001234567', $this->object->getConsumerAccountNumber());
    }

    public function testValidate()
    {
        $this->assertTrue($this->object->validate());
    }

}

