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
 * @name WirecardCEE_QMore_Response_Backend_FinancialObject
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage Response_Backend
 * @version 3.2.0
 * @abstract
 */
abstract class WirecardCEE_QMore_Response_Backend_FinancialObject {
	/**
	 * Internal data holder
	 * @var array
	 */
	protected $_data = Array();

	/**
	 * Datetime format
	 * @staticvar string
	 * @internal
	 */
	protected static $DATETIME_FORMAT = 'm.d.Y H:i:s';

	/**
	 * getter for given field
	 *
	 * @param string $name
	 * @return mixed <boolean, string>
	 */
	protected function _getField($name) {
		return (array_key_exists($name, $this->_data)) ? $this->_data[$name] : false;
	}


	/**
	 * returns internal data array
	 * @return bool
	 */
	public function getData()
	{
		return $this->_data;
	}
}