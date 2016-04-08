<?php

/*
* Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig. Software & Service Copyright (C) by Wirecard Central Eastern
* Europe GmbH, FB-Nr: FN 195599 x, http://www.wireacard.at
*/

class WirecardCEE_Stdlib_FingerprintOrderTest extends PHPUnit_Framework_TestCase {

	/**
	 *
	 * @var WirecardCEE_Stdlib_FingerprintOrder
	 */
	protected $object;
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		$this->object = new WirecardCEE_Stdlib_FingerprintOrder();
		parent::setUp();
	}

	/**
	 * @expectedException WirecardCEE_Stdlib_Exception_InvalidArgumentException
	 */
	public function testContructorForException() {
		$object = new WirecardCEE_Stdlib_FingerprintOrder(new stdClass());
	}

	public function testSetOrderWithString() {
		$sData = "first,second,third";
		$this->assertTrue($this->object->setOrder($sData));
		$this->assertEquals(3, count($this->object));
	}

	public function testSetOrderWithArray() {
		$sData = Array("first", "second", "third");
		$this->assertTrue($this->object->setOrder($sData));
		$this->assertEquals(3, count($this->object));
	}

	public function testToString() {
		$sData = "first,second,third";
		$this->object = new WirecardCEE_Stdlib_FingerprintOrder($sData);
		$this->assertEquals($sData, (string) $this->object);
	}

	public function testOffsetSet() {
		$this->object['foo'] = 'bar';
		$this->assertEquals('bar', $this->object->offsetGet('foo'));
	}

	public function testOffsetSetWithoutOffset() {
		$this->object[] = 'bar';
		$this->assertEquals('bar', $this->object->offsetGet(0));
	}

	public function testOffsetExists() {
		$this->object['foo'] = 'bar';
		$this->assertTrue($this->object->offsetExists('foo'));
	}

	public function testOffsetUnset() {
		$this->object['foo'] = 'bar';
		$this->object->offsetUnset('foo');
		$this->assertArrayNotHasKey('foo', (Array) $this->object);
	}

}

