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
use PHPUnit\Framework\TestCase;
use QentaCEE\Stdlib\FingerprintOrder;
class FingeprintTest extends QentaCEE\Stdlib\Validate\Fingerprint
{
    public function getFingerprintOrderField()
    {
        return $this->fingerprintOrderField;
    }

    public function getOrderType()
    {
        return $this->fingerprintOrderType;
    }

    public function getFingerprintOrder()
    {
        return $this->fingerprintOrder;
    }

    public function getHashAlgorithm()
    {
        return (string) $this->hashAlgorithm;
    }

    public function getMandatoryFieldsArray()
    {
        return $this->_mandatoryFields;
    }
}

/**
 * QentaCEE_Stdlib_Validate_Fingerprint test case.
 */
class QentaCEE_Stdlib_Validate_FingerprintTest extends TestCase
{

    /**
     *
     * @var FingeprintTest
     */
    private $object;

    protected $_returnData = Array(
        'amount'                   => '1',
        'currency'                 => 'EUR',
        'paymentType'              => 'QUICK',
        'financialInstitution'     => 'QUICK',
        'language'                 => 'de',
        'orderNumber'              => '16280512',
        'paymentState'             => 'SUCCESS',
        'gatewayReferenceNumber'   => 'DGW_16280512_RN',
        'gatewayContractNumber'    => 'DemoContractNumber123',
        'avsResponseCode'          => 'X',
        'avsResponseMessage'       => 'Demo AVS ResultMessage',
        'responseFingerprintOrder' => 'amount,currency,paymentType,financialInstitution,language,orderNumber,paymentState,gatewayReferenceNumber,gatewayContractNumber,avsResponseCode,avsResponseMessage,secret,responseFingerprintOrder',
        'responseFingerprint'      => '04fa5c500a19c9a71e50f258fdb62509'
    );

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        $this->object = new FingeprintTest();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown(): void
    {
        $this->object = null;
        parent::tearDown();
    }

    /**
     * Tests QentaCEE_Stdlib_Validate_Fingerprint->setFingerprintOrderField()
     */
    public function testSetFingerprintOrderField()
    {
        $this->object->setFingerprintOrderField('responseFingeprint');
        $this->assertEquals('responsefingeprint', $this->object->getFingerprintOrderField());
    }

    /**
     * Tests QentaCEE_Stdlib_Validate_Fingerprint->setOrderType()
     */
    public function testSetOrderType()
    {
        $this->object->setOrderType('fixed');
        $this->assertEquals('fixed', $this->object->getOrderType());
    }

    /**
     * Tests QentaCEE_Stdlib_Validate_Fingerprint->setOrder()
     */
    public function testSetOrder()
    {
        $order = 'test1,test2,test3,test4,test5';
        $this->object->setOrder($order);
        $oFingerprintOrder = $this->object->getFingerprintOrder();
        $this->assertInstanceOf(FingerprintOrder::class, $oFingerprintOrder);
        $this->assertIsArray($oFingerprintOrder->__toArray());
        $this->assertIsString((string) $oFingerprintOrder);
        $this->assertEquals(5, count($oFingerprintOrder));

    }

    /**
     * Tests QentaCEE_Stdlib_Validate_Fingerprint->setHashAlgorithm()
     */
    public function testSetHashAlgorithm()
    {
        $this->object->setHashAlgorithm(QentaCEE\Stdlib\Fingerprint::HASH_ALGORITHM_MD5);
        $this->assertEquals(QentaCEE\Stdlib\Fingerprint::HASH_ALGORITHM_MD5, $this->object->getHashAlgorithm());

    }

    /**
     * Tests QentaCEE_Stdlib_Validate_Fingerprint->isValid()
     */
    public function testIsValid()
    {
        $this->object->setHashAlgorithm(QentaCEE\Stdlib\Fingerprint::HASH_ALGORITHM_MD5);
        $this->object->setSecret($this->_secret);
        $this->object->setOrderType(QentaCEE\Stdlib\Validate\Fingerprint::TYPE_DYNAMIC);
        $this->object->setFingerprintOrderField('responseFingerprintOrder');
        $this->assertTrue($this->object->isValid($this->_returnData['responseFingerprint'], $this->_returnData));
    }

    public function testAddMandatoryField()
    {
        $this->object->addMandatoryField('testField');
        $this->assertTrue(in_array('testField', $this->object->getMandatoryFieldsArray()));
    }

    public function testSetMandatoryFields()
    {
        $aFields = Array('testField1', 'testField2', 'testField3', 'testField4', 'testField5');
        $this->object->setMandatoryFields($aFields);
        $this->assertTrue(in_array('testField1', $this->object->getMandatoryFieldsArray()));
    }

    public function testConstructWithZendConfigObject()
    {
        $aConfig = Array(
            'fingerprintOrder'      => 'testField1,testField2,testField3',
            'fingerprintOrderField' => 'fingerprintOrder',
            'hashAlgorithm'         => QentaCEE\Stdlib\Fingerprint::HASH_ALGORITHM_MD5,
            'orderType'             => 'dynamic',
            'secret'                => $this->_secret,
        );

        $oConfig           = new QentaCEE\Stdlib\Config($aConfig);
        $this->object      = new FingeprintTest($oConfig);
        $oFingerprintOrder = $this->object->getFingerprintOrder();
        $this->assertInstanceOf(FingerprintOrder::class, $oFingerprintOrder);
        $this->assertEquals(3, count($oFingerprintOrder));
        $this->assertEquals($this->object->getHashAlgorithm(), QentaCEE\Stdlib\Fingerprint::HASH_ALGORITHM_MD5);
    }

    public function testIsValidWithWrongHashAlgorithm()
    {
        $this -> expectException(QentaCEE\Stdlib\Exception\UnexpectedValueException::class);
        $this->object->setHashAlgorithm('notExisting');
        $this->object->setSecret($this->_secret);
        $this->object->setOrderType(QentaCEE\Stdlib\Validate\Fingerprint::TYPE_DYNAMIC);
        $this->object->setFingerprintOrderField('responseFingerprintOrder');
        $this->object->isValid($this->_returnData['responseFingerprint'], $this->_returnData);
    }

    public function testIsValidWithWrongStrLen()
    {
        $this->object->setHashAlgorithm(QentaCEE\Stdlib\Fingerprint::HASH_ALGORITHM_SHA512);
        $this->object->setSecret($this->_secret);
        $this->object->setOrderType(QentaCEE\Stdlib\Validate\Fingerprint::TYPE_DYNAMIC);
        $this->object->setFingerprintOrderField('responseFingerprintOrder');
        $this->assertFalse($this->object->isValid($this->_returnData['responseFingerprint'], $this->_returnData));
    }
}

