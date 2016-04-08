<?php

class WirecardCEE_Stdlib_Basket_ItemTest extends PHPUnit_Framework_TestCase {
	
	protected $object;
	
	public function setUp() {
		$this->object = new WirecardCEE_Stdlib_Basket_Item('WirecardCEETestItem');
	}
	
	public function testAllFunctions() {
		$this->object->setUnitPrice(10)->setTax(2)->setDescription('unittest');
		$this->assertEquals(10, $this->object->getUnitPrice());
		$this->assertEquals(2, $this->object->getTax());
		$this->assertEquals('unittest', $this->object->getDescription());
		$this->assertEquals('WirecardCEETestItem', $this->object->getArticleNumber());
	}
	
	public function tearDown() {
		$this->object->__destruct();
	}
	
	
}