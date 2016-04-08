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
 * @name WirecardCEE_QPay_Response_Toolkit_TransferFund
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage Response_Backend
 * @version 3.2.0
 */
class WirecardCEE_QPay_Response_Toolkit_TransferFund extends WirecardCEE_QPay_Response_Toolkit_ResponseAbstract {
	/**
	 * Credit number
	 * @staticvar string
	 * @internal
	 */
	private static $CREDIT_NUMBER = 'creditNumber';

	/**
	 * getter for the returned credit number
	 *
	 * @return string
	 */
	public function getCreditNumber() {
		return $this->_getField(self::$CREDIT_NUMBER);
	}
}
