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
 * @name WirecardCEE_QMore_Return_Failure
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage Return
 * @version 3.2.0
 */
 class WirecardCEE_QMore_Return_Failure extends WirecardCEE_Stdlib_Return_Failure {

    /**
     * Returns the number of errors
     * @return int
     */
    public function getNumberOfErrors() {
        return (int) $this->__get(self::$ERRORS);
    }

    /**
     * Returns all the errors
     * return Array
     */
    public function getErrors() {
        if (empty($this->_errors)) {
            $errorList = Array();

            foreach($this->__get(self::$ERROR) as $error) {
                $errorCode = $error[self::$ERROR_ERROR_CODE];
                $message = $error[self::$ERROR_MESSAGE];
                $consumerMessage = $error[self::$ERROR_CONSUMER_MESSAGE];
                $paySysMessage = $error[self::$ERROR_PAY_SYS_MESSAGE];

                $errorObject = new WirecardCEE_QMore_Error($errorCode, $message);
                $errorObject->setPaySysMessage($paySysMessage);
                $errorObject->setConsumerMessage($consumerMessage);

                array_push($errorList, $errorObject);
            }

            $this->_errors = $errorList;
        }
        return $this->_errors;
    }
}