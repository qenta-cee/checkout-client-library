<?php

class WirecardBasket extends WirecardCEE_Stdlib_Basket {

	public function getCurrency() {
		return $this->_currency;
	}

	public function getItems() {
		return $this->_items;
	}

	public function getItem($mArticleNumber) {
		return isset($this->_items[md5($mArticleNumber)]) ? $this->_items[md5($mArticleNumber)] : false;
	}

	public function getItemQuantity($mArticleNumber) {
		return $this->_getItemQuantity($mArticleNumber);
	}

	public function increaseQuantity($mArticleNumber, $iQuantity) {
		return $this->_increaseQuantity($mArticleNumber, $iQuantity);
	}
}

class WirecardCEE_Stdlib_BasketTest extends PHPUnit_Framework_TestCase {

	protected $object;

	public function setUp() {
		$this->object = new WirecardBasket();

		for($i = 0; $i < 10; $i++) {
			$_item = new WirecardCEE_Stdlib_Basket_Item("WirecardCEE_{$i}");
			$_item->setUnitPrice(($i+1) * 10)->setTax(2 * ($i+1))->setDescription("UnitTesting {$i}");
			$this->object->addItem($_item);
		}
	}

	public function testAddNewItem() {
		$this->assertInternalType('array', $this->object->getItems());
		$this->assertEquals(10, count($this->object->getItems()));
	}


	public function testIncreaseQuantity() {
		$oItem = $this->object->getItem('WirecardCEE_0');
		$this->object->addItem($oItem['instance']);
		$this->assertEquals(2, $this->object->getItemQuantity('WirecardCEE_0'));
	}

	public function testCurrency() {
		$this->object->setCurrency('USD');
		$this->assertEquals('USD', $this->object->getCurrency());
	}

	public function testAmount() {
		$this->assertEquals(660, $this->object->getAmount());
	}

	public function testToArray() {
		$array = $this->object->__toArray();
		$this->assertInternalType('array', $array);
		$this->assertArrayHasKey(WirecardCEE_Stdlib_Basket::BASKET_AMOUNT, $array);
		$this->assertEquals(660, $array[WirecardCEE_Stdlib_Basket::BASKET_AMOUNT]);
		$this->assertEquals(count($this->object->getItems()), $array[WirecardCEE_Stdlib_Basket::BASKET_ITEMS]);

	}

	/**
	 * @expectedException Exception
	 */
	public function testIncreaseQuantityForException() {
		$this->object->increaseQuantity('not_existing', 1);
	}

	public function tearDown() {
		$this->object->__destruct();
	}
}