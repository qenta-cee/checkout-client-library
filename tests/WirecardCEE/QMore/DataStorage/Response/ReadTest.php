<?php

class WirecardCEE_QMore_DataStorage_Response_ReadTest extends PHPUnit_Framework_TestCase
{
    protected $object;

    public function setUp()
    {
        $zendHttpResponse = new \GuzzleHttp\Psr7\Response(200, Array(),
            'storageId=F6G7G6F7G6F7F9G8H7JGT78OKH89K67R&javascriptUrl=https://secure.wirecard-cee.com/qmore/dataStorage/js/D200001/F6G7G6F7G6F7F9G8H7JGT78OKH89K67R/dataStorage.js&paymentInformations=1&paymentInformation.1.paymentType=PBX&paymentInformation.1.payerPayboxNumber=0123456789');
        $this->object     = new WirecardCEE_QMore_DataStorage_Response_Read($zendHttpResponse);
    }

    public function testGetStatus()
    {
        $this->assertEquals(WirecardCEE_QMore_DataStorage_Response_Read::STATE_NOT_EMPTY, $this->object->getStatus());
    }

    public function testJavascriptUrl()
    {
        $this->assertEquals('https://secure.wirecard-cee.com/qmore/dataStorage/js/D200001/F6G7G6F7G6F7F9G8H7JGT78OKH89K67R/dataStorage.js',
            $this->object->getJavascriptUrl());
    }

    public function tetGetStorageId()
    {
        $this->assertEquals('F6G7G6F7G6F7F9G8H7JGT78OKH89K67R', $this->object->getStorageId());
    }

    public function testNumberOfPaymentInformation()
    {
        $this->assertEquals(1, count($this->object->getPaymentInformation()));
        $this->assertInternalType('array', $this->object->getPaymentInformation());
        $this->assertEquals(1, $this->object->getNumberOfPaymentInformation());
        $this->assertTrue($this->object->hasPaymentInformation('PBX'));
    }

    public function testErrors()
    {
        $response = new \GuzzleHttp\Psr7\Response(200, Array(),
            'error.1.errorCode=11500&error.1.message=CUSTOMERID+is+missing&error.2.errorCode=11506&error.2.message=REQUESTFINGERPRINT+is+missing.&errors=2');
        $object   = new WirecardCEE_QMore_DataStorage_Response_Read($response);

        $this->assertEquals(2, $object->getNumberOfErrors());
        $this->assertEquals(WirecardCEE_QMore_DataStorage_Response_Read::STATE_FAILURE, $object->getStatus());
    }
}