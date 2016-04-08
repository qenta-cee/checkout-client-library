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
 * @name WirecardCEE_QMore_Response_ResponseAbstract
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage Response
 * @version 3.2.0
 * @abstract
 */
abstract class WirecardCEE_QMore_Response_ResponseAbstract extends WirecardCEE_Stdlib_Response_ResponseAbstract {
    /**
     * Errors
     * @staticvar string
     * @internal
     */
    protected static $ERRORS                     = 'errors';

    /**
     * Error
     * @staticvar string
     * @internal
     */
    protected static $ERROR                     = 'error';

    /**
     * Error code
     * @staticvar string
     * @internal
     */
    protected static $ERROR_CODE                 = 'errorCode';

    /**
     * Pay sys message
     * @staticvar string
     * @internal
     */
    protected static $ERROR_PAYSYS_MESSAGE         = 'paySysMessage';

    /**
     * getter for the Response status
     * values:
     * 0 ... success
     * 1 ... failure
     *
     * @return int
     */
    abstract public function getStatus();

    /**
     * Returns the number of errors
     * @return number
     */
    public function getNumberOfErrors() {
        return (int) $this->_getField(self::$ERRORS);
    }

    /**
     * getter for list of errors that occured
     *
     * @return WirecardCEE_QMore_Error[]
     */
    public function getErrors() {
        $aErrors = Array();
        if (empty($this->_errors)) {
            if (is_array($this->_getField(self::$ERROR))) {
                foreach($this->_getField(self::$ERROR) as $error) {
                    $errorCode =         isset($error[self::$ERROR_CODE])               ? $error[self::$ERROR_CODE] : 0;
                    $message =             isset($error[self::$ERROR_MESSAGE])          ? $error[self::$ERROR_MESSAGE]     : '';
                    $consumerMessage =     isset($error[self::$ERROR_CONSUMER_MESSAGE]) ? $error[self::$ERROR_CONSUMER_MESSAGE] : '';
                    $paySysMessage =     isset($error[self::$ERROR_PAYSYS_MESSAGE])      ? $error[self::$ERROR_PAYSYS_MESSAGE] : '';

                    $error = new WirecardCEE_QMore_Error($errorCode, $message);
                    $error->setConsumerMessage($consumerMessage);
                    $error->setPaySysMessage($paySysMessage);

                    $aErrors[] = $error;
                }
            }

            $this->_errors = $aErrors;
        }

        return $this->_errors;
    }
}