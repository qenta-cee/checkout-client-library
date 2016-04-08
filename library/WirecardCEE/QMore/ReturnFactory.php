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
 * @name WirecardCEE_QMore_ReturnFactory
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage Return
 * @version 3.2.0
 */
class WirecardCEE_QMore_ReturnFactory extends WirecardCEE_Stdlib_ReturnFactoryAbstract {
    /**
     * no initiation allowed.
     */
    private function __construct() {}

    /**
     * creates an Return instance (Cancel, Failure, Success...)
     *
     * @param array $return - returned post data
     * @param string $secret - QMORE secret
     * @return WirecardCEE_QMore_Return_Cancel|WirecardCEE_QMore_Return_Failure|WirecardCEE_QMore_Return_Pending|WirecardCEE_QMore_Return_Success
     * @throws WirecardCEE_QMore_Exception_InvalidResponseException
     */
    public static function getInstance($return, $secret) {
        if (!is_array($return)) {
            $return = WirecardCEE_Stdlib_SerialApi::decode($return);
        }

        if (array_key_exists('paymentState', $return)) {
            return self::_getInstance($return, $secret);
        }
        else {
            throw new WirecardCEE_QMore_Exception_InvalidResponseException('Invalid response from QMORE. Paymentstate is missing.');
        }
    }

    /***************************
     *       PROTECTED METHODS    *
     ***************************/

    /**
     * Returns the "return" sintance object
     *
     * @param array $return
     * @param string $secret
     * @throws WirecardCEE_QMore_Exception_InvalidResponseException
     * @return WirecardCEE_QMore_Return_Cancel|WirecardCEE_QMore_Return_Failure|WirecardCEE_QMore_Return_Pending|WirecardCEE_QMore_Return_Success
     */
    protected static function _getInstance($return, $secret) {
        switch(strtoupper($return['paymentState'])) {
            case parent::STATE_SUCCESS:
                return self::_getSuccessInstance($return, $secret);
                break;
            case parent::STATE_CANCEL:
                return new WirecardCEE_QMore_Return_Cancel($return);
                break;
            case parent::STATE_FAILURE:
                return new WirecardCEE_QMore_Return_Failure($return);
                break;
            case parent::STATE_PENDING:
                return new WirecardCEE_QMore_Return_Pending($return, $secret);
                break;
            default:
                throw new WirecardCEE_QMore_Exception_InvalidResponseException('Invalid response from QMORE. Unexpected paymentState: ' . $return['paymentState']);
                break;
        }
    }

    /**
     * getter for the correct QMORE success return instance
     *
     * @param string[] $return
     * @param string $secret
     * @return WirecardCEE_QMore_Return_Success
     * @throws WirecardCEE_QMore_Exception_InvalidResponseException
     */
    protected static function _getSuccessInstance($return, $secret) {
        if (!array_key_exists('paymentType', $return)) {
            throw new WirecardCEE_QMore_Exception_InvalidResponseException('Invalid response from QMORE. Paymenttype is missing.');
        }

        switch(strtoupper($return['paymentType'])) {
            case WirecardCEE_Stdlib_PaymentTypeAbstract::CCARD:
            case WirecardCEE_Stdlib_PaymentTypeAbstract::CCARD_MOTO:
            case WirecardCEE_Stdlib_PaymentTypeAbstract::MAESTRO:
                return new WirecardCEE_QMore_Return_Success_CreditCard($return, $secret);
                break;
            case WirecardCEE_Stdlib_PaymentTypeAbstract::PAYPAL:
                return new WirecardCEE_QMore_Return_Success_PayPal($return, $secret);
                break;
            case WirecardCEE_Stdlib_PaymentTypeAbstract::SOFORTUEBERWEISUNG:
                return new WirecardCEE_QMore_Return_Success_Sofortueberweisung($return, $secret);
                break;
            case WirecardCEE_Stdlib_PaymentTypeAbstract::IDL:
                return new WirecardCEE_QMore_Return_Success_Ideal($return, $secret);
                break;
            case WirecardCEE_Stdlib_PaymentTypeAbstract::SEPADD:
                return new WirecardCEE_QMore_Return_Success_SepaDD($return, $secret);
                break;
            default:
                return new WirecardCEE_QMore_Return_Success($return, $secret);
                break;
        }
    }
}