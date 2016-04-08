<?php
/*
* Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig. Software & Service Copyright (C) by Wirecard Central Eastern
* Europe GmbH, FB-Nr: FN 195599 x, http://www.wireacard.at
*/

class WirecardCEE_Stdlib_ModuleTest extends PHPUnit_Framework_TestCase {
	public function testClientConfig() {
		$aConfig = WirecardCEE_Stdlib_Module::getClientConfig();
		$this->assertInternalType('array', $aConfig);
		$this->assertArrayHasKey('MODULE_NAME', $aConfig);
		$this->assertEquals('WirecardCEE_Stdlib', $aConfig['MODULE_NAME']);
	}
}
