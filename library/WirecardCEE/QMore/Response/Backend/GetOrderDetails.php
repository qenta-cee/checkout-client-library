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
 * @name WirecardCEE_QMore_Response_Backend_GetOrderDetails
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage Response_Backend
 * @version 3.2.0
 */
class WirecardCEE_QMore_Response_Backend_GetOrderDetails extends WirecardCEE_QMore_Response_Backend_ResponseAbstract {
	/**
	 * Internal WirecardCEE_QMore_Response_Backend_Order holder
	 * @var WirecardCEE_QMore_Response_Backend_Order
	 */
	private $_order;

	/**
	 * Order
	 * @staticvar string
	 * @internal
	 */
	private static $ORDER 	= 'order';

	/**
	 * Payment
	 * @staticvar string
	 * @internal
	 */
	private static $PAYMENT = 'payment';

	/**
	 * Credit
	 * @staticvar string
	 * @internal
	 */
	private static $CREDIT 	= 'credit';

	/**
	 *
	 * @see WirecardCEE_QMore_Response_Backend_ResponseAbstract
	 * @param string[] $result
	 */
	public function __construct($result) {
		parent::__construct($result);
		$orders = $this->_getField(self::$ORDER);
		$payments = $this->_getField(self::$PAYMENT);
		$credits = $this->_getField(self::$CREDIT);

		$order = $orders[0];
		$order['paymentData'] = is_array($payments[0]) ? $payments[0] : Array();
		$order['creditData'] = is_array($credits[0]) ? $credits[0] : Array();

		$this->_order = new WirecardCEE_QMore_Response_Backend_Order($order);
	}

	/**
	 * getter for the returned order object
	 *
	 * @return WirecardCEE_QMore_Response_Backend_Order
	 */
	public function getOrder() {
		return $this->_order;
	}
}
