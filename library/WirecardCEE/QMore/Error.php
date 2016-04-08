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
 * @name WirecardCEE_QMore_Error
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @version 3.2.0
 */
class WirecardCEE_QMore_Error extends WirecardCEE_Stdlib_Error {
    /**
     * Error code
     *
     * @var int
     */
    protected $_errorCode = null;

    /**
     * Payment system message
     *
     * @var string
     */
    protected $_paySysMessage = null;

    /**
     * WirecardCEE_QMore_Error contructor
     *
     * @param int $errorCode
     * @param string $message
     */
    public function __construct($errorCode, $message) {
        $this->_errorCode = $errorCode;
        $this->setMessage($message);
    }

    /**
     * Error code getter
     *
     * @return int
     */
    public function getErrorCode() {
        return $this->_errorCode;
    }

    /**
     * Payment system message setter
     *
     * @param string $paySysMessage
     * @return WirecardCEE_QMore_Error
     */
    public function setPaySysMessage($paySysMessage) {
        $this->_paySysMessage = (string) $paySysMessage;
        return $this;
    }

    /**
     * Payment system message getter
     *
     * @return string
     */
    public function getPaySysMessage() {
        return (string) $this->_paySysMessage;
    }
}