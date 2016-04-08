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
 * @name WirecardCEE_QMore_DataStorage_Response_Initiation
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage DataStorage_Response
 * @version 3.2.0
 */
class WirecardCEE_QMore_DataStorage_Response_Initiation extends WirecardCEE_QMore_Response_ResponseAbstract {
    /**
     * Storage id
     * @staticvar string
     * @internal
     */
    protected static $STORAGE_ID = 'storageId';

    /**
     * Javascript url
     * @staticvar string
     * @internal
     */
    protected static $JAVASCRIPT_URL = 'javascriptUrl';

    /**
     * getter for the Response status
     * values: 0 .
     * .. success
     * 1 ... failure
     *
     * @return int
     */
    public function getStatus() {
        return ($this->_getField(self::$STORAGE_ID)) ? self::STATE_SUCCESS : self::STATE_FAILURE;
    }

    /**
     * getter for storageId returned by the dataStorage
     *
     * @return string
     */
    public function getStorageId() {
        return $this->_getField(self::$STORAGE_ID);
    }

    /**
     * getter for javascriptUrl returned by the dataStorage
     *
     * the script behind this url is used by the shopsystem to save
     * paymentInformation in the dataStorage
     *
     * @return string
     */
    public function getJavascriptUrl() {
        return $this->_getField(self::$JAVASCRIPT_URL);
    }
}