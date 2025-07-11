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

class QentaCEE_QMore_DataStorage_Response_ReadTest extends TestCase
{
    protected $object;

    public function setUp(): void 
    {
        $zendHttpResponse = new \GuzzleHttp\Psr7\Response(200, Array(),
            'storageId=F6G7G6F7G6F7F9G8H7JGT78OKH89K67R&javascriptUrl=https://papi.hobex.at/seamless/dataStorage/js/D200001/F6G7G6F7G6F7F9G8H7JGT78OKH89K67R/dataStorage.js&paymentInformations=1&paymentInformation.1.paymentType=PBX&paymentInformation.1.payerPayboxNumber=0123456789');
        $this->object     = new QentaCEE\QMore\DataStorage\Response\Read($zendHttpResponse);
    }

    public function testGetStatus()
    {
        $this->assertEquals(QentaCEE\QMore\DataStorage\Response\Read::STATE_NOT_EMPTY, $this->object->getStatus());
    }

    public function testJavascriptUrl()
    {
        $this->assertEquals('https://papi.hobex.at/seamless/dataStorage/js/D200001/F6G7G6F7G6F7F9G8H7JGT78OKH89K67R/dataStorage.js',
            $this->object->getJavascriptUrl());
    }

    public function tetGetStorageId()
    {
        $this->assertEquals('F6G7G6F7G6F7F9G8H7JGT78OKH89K67R', $this->object->getStorageId());
    }

    public function testNumberOfPaymentInformation()
    {
        $this->assertEquals(1, count($this->object->getPaymentInformation()));
        $this->assertIsArray($this->object->getPaymentInformation());
        $this->assertEquals(1, $this->object->getNumberOfPaymentInformation());
        $this->assertTrue($this->object->hasPaymentInformation('PBX'));
    }

    public function testErrors()
    {
        $response = new \GuzzleHttp\Psr7\Response(200, Array(),
            'error.1.errorCode=11500&error.1.message=CUSTOMERID+is+missing&error.2.errorCode=11506&error.2.message=REQUESTFINGERPRINT+is+missing.&errors=2');
        $object   = new QentaCEE\QMore\DataStorage\Response\Read($response);

        $this->assertEquals(2, $object->getNumberOfErrors());
        $this->assertEquals(QentaCEE\QMore\DataStorage\Response\Read::STATE_FAILURE, $object->getStatus());
    }
}
