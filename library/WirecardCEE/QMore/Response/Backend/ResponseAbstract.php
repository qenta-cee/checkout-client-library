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
 * @name WirecardCEE_QMore_Response_Backend_ResponseAbstract
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage Response_Backend
 * @version 3.2.0
 * @abstract
 */
abstract class WirecardCEE_QMore_Response_Backend_ResponseAbstract extends WirecardCEE_QMore_Response_ResponseAbstract {
	/**
	 * Status
	 * @staticvar string
	 * @internal
	 */
	private static $STATUS = 'status';

	/**
	 * getter for the toolkit operation status
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->_getField(self::$STATUS);
	}
}