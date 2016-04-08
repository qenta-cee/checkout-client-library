<?php
/*
* Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig.
*
* Software & Service Copyright (C) by
* Wirecard Central Eastern Europe GmbH,
* FB-Nr: FN 195599 x, http://www.wirecard.at
*/
/**
 * @name WirecardCEE_QMore_Response_Backend_Order_OrderIterator
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage Response_Backend_Order
 * @version 3.2.0
 * @abstract
 */
abstract class WirecardCEE_QMore_Response_Backend_Order_OrderIterator implements Iterator {
	/**
	 * Internal position holder
	 * @var int
	 */
	protected $_position;

	/**
	 *¸Internal objects holder
	 * @var array
	 */
	protected $_objectArray;

	/**
	 * Constructor
	 * @param array $objectArray objects to iterate through
	 */
	public function __construct(array $objectArray) {
		$this->_position = 0;
		$this->_objectArray = $objectArray;
	}

	/**
	 * resets the current position to 0(first entry)
	 */
	public function rewind() {
		$this->_position = 0;
	}

	/**
	 * Returns the current object
	 * @return Object
	 */
	public function current() {
		return $this->_objectArray[$this->_position];
	}

	/**
	 * Returns the current position
	 * @return int
	 */
	public function key() {
		return (int) $this->_position;
	}

	/**
	 * go to the next position
	 */
	public function next() {
		++$this->_position;
	}

	/**
	 * checks if position is valid
	 * @return bool
	 */
	public function valid() {
		return (bool) isset($this->_objectArray[$this->_position]);
	}

	public function getArray()
	{
		return $this->_objectArray;
	}
}