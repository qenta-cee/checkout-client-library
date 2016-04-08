<?php

class FakeModule extends WirecardCEE_Stdlib_Module_ModuleAbstract {
	public static function getConfig() {
		return Array('userConfig');
	}
	
	public static function getClientConfig() {
		return Array('clientConfig');
	}
}

class WirecardCEE_Stdlib_Module_ModuleAbstractTest extends PHPUnit_Framework_TestCase {
	public function testConfigs() {
		$aUserConfig = FakeModule::getConfig(); 
		$aClientConfig = FakeModule::getClientConfig(); 
		
		$this->assertInternalType('array', $aUserConfig);
		$this->assertInternalType('array', $aClientConfig);
		
		$this->assertEquals('userConfig', $aUserConfig[0]);
		$this->assertEquals('clientConfig', $aClientConfig[0]);
		
		WirecardCEE_Stdlib_Module_ModuleAbstract::getConfig();
		WirecardCEE_Stdlib_Module_ModuleAbstract::getClientConfig();
		
	}
}