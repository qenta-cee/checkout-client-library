<?php


/**
 * WirecardCEE_QMore_DataStorage_Request_Read test case.
 */
class WirecardCEE_QMore_DataStorage_Request_ReadTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @var string
     */
    private $sReturnUrl = 'http://<setthis>/library/confirm.php';

    /**
     *
     * @var string
     */
    private $sOrderIdent = 'phpunit test';
    /**
     *
     * @var WirecardCEE_QMore_DataStorage_Request_Read
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new WirecardCEE_QMore_DataStorage_Request_Read();

    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->object = null;
        parent::tearDown();
    }

    public function testRead()
    {
        $oClient                   = new WirecardCEE_QMore_DataStorageClient();
        $oQMoreDataStorageResponse = $oClient->setOrderIdent($this->sOrderIdent)->setReturnUrl($this->sReturnUrl)->initiate();
        $sStorageId                = $oQMoreDataStorageResponse->getStorageId();
        $oQMoreDataStorageRead     = $this->object->read($sStorageId);

        $this->assertInstanceOf('WirecardCEE_QMore_DataStorage_Response_Read', $oQMoreDataStorageRead);
        $this->assertEquals($oQMoreDataStorageRead->getStatus(), 0);
        $this->assertEquals($oQMoreDataStorageRead->getStorageId(), $sStorageId);
        $this->assertEmpty($oQMoreDataStorageRead->getErrors());
    }

    /**
     * @expectedException WirecardCEE_QMore_DataStorage_Exception_InvalidArgumentException
     */
    public function testWithNoCustomerId()
    {
        $this->object = new WirecardCEE_QMore_DataStorage_Request_Read(Array(
            'WirecardCEEQMoreConfig' => Array(
                'CUSTOMER_ID' => '',
                'SHOP_ID'     => '',
                'SECRET'      => 'B8AKTPWBRMNBV455FG6M2DANE99WU2',
                'LANGUAGE'    => 'en'
            )
        ));
    }

    /**
     * @expectedException WirecardCEE_QMore_DataStorage_Exception_InvalidArgumentException
     */
    public function testWithNoSecret()
    {
        $this->object = new WirecardCEE_QMore_DataStorage_Request_Read(Array(
            'WirecardCEEQMoreConfig' => Array(
                'CUSTOMER_ID' => 'D200001',
                'SHOP_ID'     => '',
                'SECRET'      => '',
                'LANGUAGE'    => 'en'
            )
        ));
    }

    /**
     * @expectedException WirecardCEE_QMore_DataStorage_Exception_InvalidArgumentException
     */
    public function testWithNoLanguage()
    {
        $this->object = new WirecardCEE_QMore_DataStorage_Request_Read(Array(
            'WirecardCEEQMoreConfig' => Array(
                'CUSTOMER_ID' => 'D200001',
                'SHOP_ID'     => '',
                'SECRET'      => 'B8AKTPWBRMNBV455FG6M2DANE99WU2',
                'LANGUAGE'    => ''
            )
        ));
    }

}

