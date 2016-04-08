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
 * @name WirecardCEE_QMore_DataStorage_Response_Read
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage DataStorage_Response
 * @version 3.2.0
 */
class WirecardCEE_QMore_DataStorage_Response_Read extends WirecardCEE_QMore_Response_ResponseAbstract {
    /**
     * Const: state - existing
     * @var int
     */
    const STATE_EXISTING             = 0;

    /**
     * Const: state - not empty
     * @var int
     */
    const STATE_NOT_EMPTY             = 1;

    /**
     * Const: state - not existing
     * @var int
     */
    const STATE_NOT_EXISTING         = 2;

    /**
     * Const: state - failure
     * @var int
     */
    const STATE_FAILURE             = 3;

    /**
     * Payment type: credit card
     * @var string
     */
    const PAYMENTTYPE_CREDITCARD     = 'CCARD';

    /**
     * Payment type: elv
     * @var string
     */
    const PAYMENTTYPE_ELV             = 'ELV';

    /**
     * Payment type: giropay
     * @var string
     */
    const PAYMENTTYPE_GIROPAY         = 'GIROPAY';

    /**
     * Payment type: pbx (mobile payment)
     * @var string
     */
    const PAYMENTTYPE_PAYBOX        = 'PBX';

    /**
     * Storage id
     * @var string
     */
    const STORAGE_ID                 = 'storageId';

    /**
     * Javascript url
     * @var string
     */
    const JAVASCRIPT_URL            = 'javascriptUrl';

    /**
     * Error
     * @staticvar string
     * @internal
     */
    protected static $ERROR                 = 'error';

    /**
     * Payment inf
     * @staticvar string
     * @internal
     */
    protected static $PAYMENT_INFORMATION     = 'paymentInformation';

    /**
     * Storage id
     * @staticvar string
     * @internal
     */
    protected static $PAYMENT_INFORMATIONS     = 'paymentInformations';

    /**
     * Internal errors holder
     * @var array
     */
    protected $_errors = Array();

    /**
     * getter for the Response status
     * values: 0 .
     * .. storageId exists and is empty
     * 1 ... storageId exists and not is empty
     * 2 ... storageId does not exist
     * 3 ... an error occured
     *
     * @return int
     */
    public function getStatus() {
        if ($this->_getField(self::STORAGE_ID)) {
            return ($this->_getField(self::$PAYMENT_INFORMATION)) ? self::STATE_NOT_EMPTY : self::STATE_EXISTING;
        }
        else {
            return ($this->_getField(self::$ERRORS)) ? self::STATE_FAILURE : self::STATE_NOT_EXISTING;
        }
    }

    /**
     * getter for all stored anonymized paymentInformation
     *
     * @param string $paymentType
     *            - filter only one paymenttype
     * @return mixed[]
     */
    public function getPaymentInformation($paymentType = null) {
        $paymentInformation = $this->_getField(self::$PAYMENT_INFORMATION);
        if (is_array($paymentInformation)) {
            if (!is_null($paymentType)) {
                $paymentType = strtoupper($paymentType);
                foreach($paymentInformation as $singlePaymentInformation) {
                    if ($singlePaymentInformation['paymentType'] == $paymentType) {
                        return $singlePaymentInformation;
                    }
                }
                return Array();
            }
            else {
                return $paymentInformation;
            }
        }
        else {
            return Array();
        }
    }

    /**
     * Returns the number of payment information
     *
     * @return int
     */
    public function getNumberOfPaymentInformation() {
        return $this->_getField(self::$PAYMENT_INFORMATIONS);
    }

    /**
     * Cheks if the given payment type has any payment information
     *
     * @param string $paymentType
     * @return boolean
     */
    public function hasPaymentInformation($paymentType) {
        $paymentInformation = $this->getPaymentInformation($paymentType);
        return !empty($paymentInformation);
    }

    /**
     * getter for storageId returned by the dataStorage
     *
     * @return string
     */
    public function getStorageId() {
        return (string) $this->_getField(self::STORAGE_ID);
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
        return (string) $this->_getField(self::JAVASCRIPT_URL);
    }
}