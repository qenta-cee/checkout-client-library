<?php

class WirecardCEE_QPay_ModuleTest extends PHPUnit_Framework_TestCase
{
    public function testClientConfig()
    {
        $aConfig = WirecardCEE_QPay_Module::getClientConfig();
        $this->assertInternalType('array', $aConfig);
        $this->assertArrayHasKey('MODULE_NAME', $aConfig);
        $this->assertArrayHasKey('FRONTEND_URL', $aConfig);
        $this->assertArrayHasKey('TOOLKIT_URL', $aConfig);
        $this->assertArrayHasKey('DEPENDENCIES', $aConfig);
        $this->assertEquals('WirecardCEE_QPay', $aConfig['MODULE_NAME']);
    }

    public function testUserConfig()
    {
        $aConfig = WirecardCEE_QPay_Module::getConfig();
        $this->assertInternalType('array', $aConfig);
        $this->assertArrayHasKey('WirecardCEEQPayConfig', $aConfig);
        $this->assertArrayHasKey('CUSTOMER_ID', $aConfig['WirecardCEEQPayConfig']);
        $this->assertArrayHasKey('SHOP_ID', $aConfig['WirecardCEEQPayConfig']);
        $this->assertArrayHasKey('LANGUAGE', $aConfig['WirecardCEEQPayConfig']);
        $this->assertArrayHasKey('SECRET', $aConfig['WirecardCEEQPayConfig']);
    }
}
