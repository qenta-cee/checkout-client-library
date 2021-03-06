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
 * QentaCEE_QMore_DataStorage_Request_Read test case.
 */
use PHPUnit\Framework\TestCase;
use QentaCEE\QMore\DataStorage\Response\Read;
class QentaCEE_QMore_DataStorage_Request_ReadTest extends TestCase
{
    /**
     *
     * @var string
     */
    private $sReturnUrl = 'http://foo.bar.com/library/storageReturn.php';

    /**
     *
     * @var string
     */
    private $sOrderIdent = 'phpunit test';
    /**
     *
     * @var QentaCEE_QMore_DataStorage_Request_Read
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void 
    {
        parent::setUp();
        $this->object = new QentaCEE\QMore\DataStorage\Request\Read();

    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown(): void 
    {
        $this->object = null;
        parent::tearDown();
    }

    public function testRead()
    {
        $oClient                   = new QentaCEE\QMore\DataStorageClient();
        $oQMoreDataStorageResponse = $oClient->setOrderIdent($this->sOrderIdent)->setReturnUrl($this->sReturnUrl)->initiate();
        $sStorageId                = $oQMoreDataStorageResponse->getStorageId();
        $oQMoreDataStorageRead     = $this->object->read($sStorageId);

        $this->assertInstanceOf(Read::class, $oQMoreDataStorageRead);
        $this->assertEquals($oQMoreDataStorageRead->getStatus(), 0);
        $this->assertEquals($oQMoreDataStorageRead->getStorageId(), $sStorageId);
        $this->assertEmpty($oQMoreDataStorageRead->getErrors());
    }

    public function testWithNoCustomerId()
    {
        $this -> expectException(QentaCEE\QMore\DataStorage\Exception\InvalidArgumentException::class);
        $this->object = new QentaCEE\QMore\DataStorage\Request\Read(Array(
            'QentaCEEQMoreConfig' => Array(
                'CUSTOMER_ID' => '',
                'SHOP_ID'     => '',
                'SECRET'      => 'B8AKTPWBRMNBV455FG6M2DANE99WU2',
                'LANGUAGE'    => 'en'
            )
        ));
    }

    public function testWithNoSecret()
    {
        $this -> expectException(QentaCEE\QMore\DataStorage\Exception\InvalidArgumentException::class);
        $this->object = new QentaCEE\QMore\DataStorage\Request\Read(Array(
            'QentaCEEQMoreConfig' => Array(
                'CUSTOMER_ID' => 'D200001',
                'SHOP_ID'     => '',
                'SECRET'      => '',
                'LANGUAGE'    => 'en'
            )
        ));
    }

    public function testWithNoLanguage()
    {
        $this -> expectException(QentaCEE\QMore\DataStorage\Exception\InvalidArgumentException::class);
        $this->object = new QentaCEE\QMore\DataStorage\Request\Read(Array(
            'QentaCEEQMoreConfig' => Array(
                'CUSTOMER_ID' => 'D200001',
                'SHOP_ID'     => '',
                'SECRET'      => 'B8AKTPWBRMNBV455FG6M2DANE99WU2',
                'LANGUAGE'    => ''
            )
        ));
    }

}

