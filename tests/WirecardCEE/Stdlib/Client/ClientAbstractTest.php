<?php


class TestClient extends WirecardCEE_Stdlib_Client_ClientAbstract
{
    public function __construct($aConfig = null)
    {
        $this->oClientConfig = $aConfig;
    }

    public function setField($name, $value)
    {
        parent::_setField($name, $value);
    }

    public function _getUserAgent()
    {
        return __CLASS__;
    }

    public function _getRequestUrl()
    {
        return "http://www.google.at";
    }

    public function getHttpClient()
    {
        return $this->_getHttpClient();
    }
}

class WirecardCEE_Stdlib_Client_ClientAbstractTest extends PHPUnit_Framework_TestCase
{

    protected $object;

    public function setUp()
    {
        $this->object = new TestClient(WirecardCEE_Stdlib_Module::getClientConfig());
    }

    public function testSetZendHttpClient()
    {
        $this->object->setHttpClient(new GuzzleHttp\Client());
        $this->assertInstanceOf('GuzzleHttp\Client', $this->object->getHttpClient());
    }

    public function testClientConfig()
    {
        $_oClientConfig = $this->object->getClientConfig();
        $this->assertArrayHasKey('MODULE_NAME', $_oClientConfig);
        $this->assertArrayHasKey('MODULE_VERSION', $_oClientConfig);
        $this->assertArrayHasKey('DEPENDENCIES', $_oClientConfig);
    }

    public function testUserAgentString()
    {
        $sUserAgent = $this->object->getUserAgentString();
        $this->assertContains(get_class($this->object), $sUserAgent);
        $this->assertContains('WirecardCEE_Stdlib', $sUserAgent);
    }

    public function testGetRequestData()
    {
        $this->object->setField('field1', 'value1');
        $this->object->setField('field2', 'value2');
        $this->object->setField('field3', 'value3');

        $this->assertInternalType('array', $this->object->getRequestData());
        $this->assertEquals(3, count($this->object->getRequestData()));
    }

    public function tearDown()
    {
        unset( $this->object );
    }

}