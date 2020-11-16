<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Qenta Payment CEE GmbH
 * (abbreviated to Qenta CEE) and are explicitly not part of the Qenta CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Qenta CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Qenta CEE does not guarantee their full
 * functionality neither does Qenta CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Qenta CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */


namespace QentaCEE\QPay;
use QentaCEE\QPay\Exception\InvalidResponseException;
use QentaCEE\QPay\Returns\Cancel;
use QentaCEE\QPay\Returns\Failure;
use QentaCEE\QPay\Returns\Pending;
use QentaCEE\Stdlib\PaymentTypeAbstract;
use QentaCEE\QPay\Returns\Success\CreditCard;
use QentaCEE\QPay\Returns\Success\PayPal;
use QentaCEE\QPay\Returns\Success\Sofortueberweisung;
use QentaCEE\QPay\Returns\Success\Ideal;
use QentaCEE\QPay\Returns\Success;
class ReturnFactory extends \QentaCEE\Stdlib\ReturnFactoryAbstract
{
    /**
     * no initiation allowed.
     */
    private function __construct() { }

    /**
     * creates an Return instance (Cancel, Failure, Success...)
     *
     * @param $return
     * @param $secret
     *
     * @return \QentaCEE\Stdlib\Return\ReturnAbstract
     * @throws InvalidResponseException
     */
    public static function getInstance($return, $secret)
    {
        if (!is_array($return)) {
            $return = \QentaCEE\Stdlib\SerialApi::decode($return);
        }

        if (array_key_exists('paymentState', $return)) {
            return self::_getInstance($return, $secret);
        } else {
            throw new InvalidResponseException('Invalid response from QPAY. Paymentstate is missing.');
        }
    }

    /***************************
     *       PROTECTED METHODS    *
     ***************************/

    /**
     *
     * @param array $return
     * @param string $secret
     *
     * @throws InvalidResponseException
     * @return Mixed <Success, CreditCard, PayPal, Sofortueberweisung, Ideal>|Cancel|Failure
     */
    protected static function _getInstance($return, $secret)
    {
        switch (strtoupper($return['paymentState'])) {
            case self::STATE_SUCCESS:
                return self::_getSuccessInstance($return, $secret);
                break;
            case self::STATE_CANCEL:
                return new Cancel($return);
                break;
            case self::STATE_FAILURE:
                return new Failure($return);
                break;
            case parent::STATE_PENDING:
                return new Pending($return, $secret);
                break;
            default:
                throw new InvalidResponseException('Invalid response from QPAY. Unexpected paymentState: ' . $return['paymentState']);
                break;
        }
    }

    /**
     * getter for the correct qpay success return instance
     *
     * @param string[] $return
     * @param string $secret
     *
     * @return Success|CreditCard|Ideal|PayPal|Sofortueberweisung
     * @throws InvalidResponseException
     */
    protected static function _getSuccessInstance($return, $secret)
    {
        if (!array_key_exists('paymentType', $return)) {
            throw new InvalidResponseException('Invalid response from QPAY. Paymenttype is missing.');
        }

        switch (strtoupper($return['paymentType'])) {
            case PaymentTypeAbstract::CCARD:
            case PaymentTypeAbstract::CCARD_MOTO:
            case PaymentTypeAbstract::MAESTRO:
                return new CreditCard($return, $secret);
                break;
            case PaymentTypeAbstract::PAYPAL:
                return new PayPal($return, $secret);
                break;
            case PaymentTypeAbstract::SOFORTUEBERWEISUNG:
                return new Sofortueberweisung($return, $secret);
                break;
            case PaymentTypeAbstract::IDL:
                return new Ideal($return, $secret);
                break;
            default:
                return new Success($return, $secret);
                break;
        }
    }
}