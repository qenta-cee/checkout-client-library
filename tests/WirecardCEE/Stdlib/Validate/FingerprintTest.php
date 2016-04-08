<?php


class FingeprintTest extends WirecardCEE_Stdlib_Validate_Fingerprint {
    public function getFingerprintOrderField() {
        return $this->fingerprintOrderField;
    }

    public function getOrderType() {
        return $this->fingerprintOrderType;
    }

    public function getFingerprintOrder() {
        return $this->fingerprintOrder;
    }

    public function getHashAlgorithm() {
        return (string) $this->hashAlgorithm;
    }

    public function getMandatoryFieldsArray() {
        return $this->_mandatoryFields;
    }
}
/**
 * WirecardCEE_Stdlib_Validate_Fingerprint test case.
 */
class WirecardCEE_Stdlib_Validate_FingerprintTest extends PHPUnit_Framework_TestCase {

    /**
     *
     * @var FingeprintTest
     */
    private $object;

    protected $_returnData = Array(
            'amount' => '1',
            'currency' => 'EUR',
            'paymentType' => 'QUICK',
            'financialInstitution' => 'QUICK',
            'language' => 'de',
            'orderNumber' => '16280512',
            'paymentState' => 'SUCCESS',
            'gatewayReferenceNumber' => 'DGW_16280512_RN',
            'gatewayContractNumber' => 'DemoContractNumber123',
            'avsResponseCode' => 'X',
            'avsResponseMessage' => 'Demo AVS ResultMessage',
            'responseFingerprintOrder' => 'amount,currency,paymentType,financialInstitution,language,orderNumber,paymentState,gatewayReferenceNumber,gatewayContractNumber,avsResponseCode,avsResponseMessage,secret,responseFingerprintOrder',
            'responseFingerprint' => '04fa5c500a19c9a71e50f258fdb62509');

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp() {
        $this->object = new FingeprintTest();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown() {
        $this->object = null;
        parent::tearDown();
    }

    /**
     * Tests WirecardCEE_Stdlib_Validate_Fingerprint->setFingerprintOrderField()
     */
    public function testSetFingerprintOrderField() {
        $this->object->setFingerprintOrderField('responseFingeprint');
        $this->assertEquals('responsefingeprint', $this->object->getFingerprintOrderField());
    }

    /**
     * Tests WirecardCEE_Stdlib_Validate_Fingerprint->setOrderType()
     */
    public function testSetOrderType() {
        $this->object->setOrderType('fixed');
        $this->assertEquals('fixed', $this->object->getOrderType());
    }

    /**
     * Tests WirecardCEE_Stdlib_Validate_Fingerprint->setOrder()
     */
    public function testSetOrder() {
        $order = 'test1,test2,test3,test4,test5';
        $this->object->setOrder($order);
        $oFingerprintOrder = $this->object->getFingerprintOrder();
        $this->assertInstanceOf('WirecardCEE_Stdlib_FingerprintOrder', $oFingerprintOrder);
        $this->assertInternalType('array', $oFingerprintOrder->__toArray());
        $this->assertInternalType('string', (string) $oFingerprintOrder);
        $this->assertEquals(5, count($oFingerprintOrder));

    }

    /**
     * Tests WirecardCEE_Stdlib_Validate_Fingerprint->setHashAlgorithm()
     */
    public function testSetHashAlgorithm() {
        $this->object->setHashAlgorithm(WirecardCEE_Stdlib_Fingerprint::HASH_ALGORITHM_MD5);
        $this->assertEquals(WirecardCEE_Stdlib_Fingerprint::HASH_ALGORITHM_MD5, $this->object->getHashAlgorithm());

    }

    /**
     * Tests WirecardCEE_Stdlib_Validate_Fingerprint->isValid()
     */
    public function testIsValid() {
        $this->object->setHashAlgorithm(WirecardCEE_Stdlib_Fingerprint::HASH_ALGORITHM_MD5);
        $this->object->setSecret($this->_secret);
        $this->object->setOrderType(WirecardCEE_Stdlib_Validate_Fingerprint::TYPE_DYNAMIC);
        $this->object->setFingerprintOrderField('responseFingerprintOrder');
        $this->assertTrue($this->object->isValid($this->_returnData['responseFingerprint'], $this->_returnData));
    }

    public function testAddMandatoryField() {
        $this->object->addMandatoryField('testField');
        $this->assertTrue(in_array('testField', $this->object->getMandatoryFieldsArray()));
    }

    public function testSetMandatoryFields() {
        $aFields = Array('testField1', 'testField2', 'testField3', 'testField4', 'testField5');
        $this->object->setMandatoryFields($aFields);
        $this->assertTrue(in_array('testField1', $this->object->getMandatoryFieldsArray()));
    }

    public function testConstructWithZendConfigObject() {
        $aConfig = Array(
                'fingerprintOrder' => 'testField1,testField2,testField3',
                'fingerprintOrderField' => 'fingerprintOrder',
                'hashAlgorithm' => WirecardCEE_Stdlib_Fingerprint::HASH_ALGORITHM_MD5,
                'orderType' => 'dynamic',
                'secret' => $this->_secret,
        );

        $oConfig = new WirecardCEE_Stdlib_Config($aConfig);
        $this->object = new FingeprintTest($oConfig);
        $oFingerprintOrder = $this->object->getFingerprintOrder();
        $this->assertInstanceOf('WirecardCEE_Stdlib_FingerprintOrder', $oFingerprintOrder);
        $this->assertEquals(3, count($oFingerprintOrder));
        $this->assertEquals($this->object->getHashAlgorithm(), WirecardCEE_Stdlib_Fingerprint::HASH_ALGORITHM_MD5);
    }

    /**
     * @expectedException WirecardCEE_Stdlib_Exception_UnexpectedValueException
     */
    public function testIsValidWithWrongHashAlgorithm() {
        $this->object->setHashAlgorithm('notExisting');
        $this->object->setSecret($this->_secret);
        $this->object->setOrderType(WirecardCEE_Stdlib_Validate_Fingerprint::TYPE_DYNAMIC);
        $this->object->setFingerprintOrderField('responseFingerprintOrder');
        $this->object->isValid($this->_returnData['responseFingerprint'], $this->_returnData);
    }

    public function testIsValidWithWrongStrLen() {
        $this->object->setHashAlgorithm(WirecardCEE_Stdlib_Fingerprint::HASH_ALGORITHM_SHA512);
        $this->object->setSecret($this->_secret);
        $this->object->setOrderType(WirecardCEE_Stdlib_Validate_Fingerprint::TYPE_DYNAMIC);
        $this->object->setFingerprintOrderField('responseFingerprintOrder');
        $this->assertFalse($this->object->isValid($this->_returnData['responseFingerprint'], $this->_returnData));
    }
}

