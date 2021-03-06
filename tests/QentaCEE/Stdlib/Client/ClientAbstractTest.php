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

class TestClient extends QentaCEE\Stdlib\Client\ClientAbstract
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

class QentaCEE_Stdlib_Client_ClientAbstractTest extends TestCase
{

    protected $object;

    public function setUp(): void
    {
        $this->object = new TestClient(QentaCEE\Stdlib\Module::getClientConfig());
    }

    public function testSetZendHttpClient()
    {
        $this->object->setHttpClient(new GuzzleHttp\Client());
        $this->assertInstanceOf(GuzzleHttp\Client::class, $this->object->getHttpClient());
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
        $this->assertStringContainsString(get_class($this->object), $sUserAgent);
        $this->assertStringContainsString('QentaCEE_Stdlib', $sUserAgent);
    }

    public function testGetRequestData()
    {
        $this->object->setField('field1', 'value1');
        $this->object->setField('field2', 'value2');
        $this->object->setField('field3', 'value3');

        $this->assertIsArray($this->object->getRequestData());
        $this->assertEquals(3, count($this->object->getRequestData()));
    }

    public function tearDown(): void
    {
        unset( $this->object );
    }

}