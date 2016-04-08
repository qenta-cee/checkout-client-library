<?php


class WirecardCEE_QMore_ModuleTest extends PHPUnit_Framework_TestCase
{
    public function testClientConfig()
    {
        $aConfig = WirecardCEE_QMore_Module::getClientConfig();
        $this->assertInternalType('array', $aConfig);
        $this->assertArrayHasKey('MODULE_NAME', $aConfig);
        $this->assertArrayHasKey('DATA_STORAGE_URL', $aConfig);
        $this->assertArrayHasKey('FRONTEND_URL', $aConfig);
        $this->assertEquals('WirecardCEE_QMore', $aConfig['MODULE_NAME']);
    }

    public function testUserConfig()
    {
        $aConfig = WirecardCEE_QMore_Module::getConfig();
        $this->assertInternalType('array', $aConfig);
        $this->assertArrayHasKey('WirecardCEEQMoreConfig', $aConfig);
        $this->assertArrayHasKey('CUSTOMER_ID', $aConfig['WirecardCEEQMoreConfig']);
        $this->assertArrayHasKey('SHOP_ID', $aConfig['WirecardCEEQMoreConfig']);
        $this->assertArrayHasKey('LANGUAGE', $aConfig['WirecardCEEQMoreConfig']);
        $this->assertArrayHasKey('SECRET', $aConfig['WirecardCEEQMoreConfig']);
    }
}
