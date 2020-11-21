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


namespace QentaCEE\QMore;
use QentaCEE\Stdlib\Client\ClientAbstract;
use QentaCEE\Stdlib\FingerprintOrder;
use QentaCEE\Stdlib\Config;
use QentaCEE\QMore\Exception\InvalidArgumentException;
use QentaCEE\QMore\Response\Backend\GetFinancialInstitutions;
use QentaCEE\Stdlib\ClientException\InvalidResponseException;
use QentaCEE\QMore\Response\Backend\Refund;
use QentaCEE\QMore\Response\Backend\RefundReversal;
use QentaCEE\QMore\Response\Backend\RecurPayment;
use QentaCEE\QMore\Response\Backend\GetOrderDetails;
use QentaCEE\QMore\Response\Backend\ApproveReversal;
use QentaCEE\QMore\Response\Backend\Deposit;
use QentaCEE\QMore\Response\Backend\DepositReversal;
use QentaCEE\QMore\Request\Backend\TransferFund\Existing;
use QentaCEE\QMore\Request\Backend\TransferFund\SkrillWallet;
use QentaCEE\QMore\Request\Backend\TransferFund\Moneta;
use QentaCEE\QMore\Request\Backend\TransferFund\SepaCT;
use QentaCEE\Stdlib\Exception\InvalidTypeException;
use QentaCEE\QMore\Request\Backend\TransferFund;
use QentaCEE\QMore\Module;
class BackendClient extends ClientAbstract
{
    /**
     * Password
     *
     * @var string
     */
    const PASSWORD = 'password';

    /**
     * Payment Number
     *
     * @var string
     */
    const PAYMENT_NUMBER = 'paymentNumber';

    /**
     * Credit number
     *
     * @var string
     */
    const CREDIT_NUMBER = 'creditNumber';

    /**
     * Source order number
     *
     * @var string
     */
    const SOURCE_ORDER_NUMBER = 'sourceOrderNumber';

    /**
     * Order reference
     *
     * @var string
     */
    const ORDER_REFERENCE = 'orderReference';

    /**
     * Customer statement
     *
     * @var string
     */
    const CUSTOMER_STATEMENT = 'customerStatement';

    /**
     * Payment type
     *
     * @var string
     */
    const PAYMENTTYPE = 'paymentType';

    /**
     * Comma-separed list of customer country codes.
     *
     * @var string
     */
    const BANKCOUNTRY = 'bankCountry';

    /**
     * Transactiontype ONLINE, OFFLINE, or ALL.
     *
     * @var string
     */
    const TRANSACTIONTYPE = 'transactionType';

    /**
     * Consumer E-Mail
     *
     * @var string
     */
    const CONSUMEREMAIL = 'consumerEmail';

    /**
     * Consumer Wallet Id
     *
     * @var string
     */
    const CONSUMERWALLETID = 'consumerWalletId';

    /**
     * Bank account owner
     *
     * @var string
     */
    const BANKACCOUNTOWNER = 'bankAccountOwner';
    /**
     * BIC
     *
     * @var string
     */
    const BANKBIC = 'bankBic';

    /**
     * IBAN
     *
     * @var string
     */
    const BANKACCOUNTIBAN = 'bankAccountIban';

    /**
     * Command
     *
     * @var string
     */
    const COMMAND = 'command';

    /**
     * Plugin version
     *
     * @var string
     */
    const PLUGIN_VERSION = 'pluginVersion';

    /**
     * Command: Approve reversal
     *
     * @staticvar string
     * @internal
     */
    protected static $COMMAND_APPROVE_REVERSAL = 'approveReversal';

    /**
     * Command: Deposit
     *
     * @staticvar string
     * @internal
     */
    protected static $COMMAND_DEPOSIT = 'deposit';

    /**
     * Command: Deposit reveresal
     *
     * @staticvar string
     * @internal
     */
    protected static $COMMAND_DEPOSIT_REVERSAL = 'depositReversal';

    /**
     * Command: Get order details
     *
     * @staticvar string
     * @internal
     */
    protected static $COMMAND_GET_ORDER_DETAILS = 'getOrderDetails';

    /**
     * Command: Recur payment
     *
     * @staticvar string
     * @internal
     */
    protected static $COMMAND_RECUR_PAYMENT = 'recurPayment';

    /**
     * Command: Refund
     *
     * @staticvar string
     * @internal
     */
    protected static $COMMAND_REFUND = 'refund';

    /**
     * Command: Refund reversal
     *
     * @staticvar string
     * @internal
     */
    protected static $COMMAND_REFUND_REVERSAL = 'refundReversal';

    /**
     * Command: Transfer fund
     *
     * @staticvar string
     */
    protected static $COMMAND_TRANSFER_FUND = 'transferFund';

    /**
     * @staticvar string
     */
    public static $TRANSFER_FUND_TYPE_EXISTING = 'EXISTINGORDER';

    /**
     * @staticvar string
     */
    public static $TRANSFER_FUND_TYPE_SKIRLLWALLET = 'SKRILLWALLET';

    /**
     * @staticvar string
     */
    public static $TRANSFER_FUND_TYPE_MONETA = 'MONETA';

    /**
     * @staticvar string
     */
    public static $TRANSFER_FUND_TYPE_SEPACT = 'SEPA-CT';

    /**
     * Command: Get Financial Institutions
     *
     * @staticvar string
     * @internal
     */
    protected static $COMMAND_GET_FINANCIAL_INSTITUTIONS = 'getFinancialInstitutions';

    /**
     * using FIXED fingerprint order (0 = dynamic, 1 = fixed)
     *
     * @var int
     */
    protected $_fingerprintOrderType = 1;

    /**
     * Creates an instance of an BackendClient object.
     *
     * @param array|Config $config
     */
    public function __construct($config = null)
    {
        $this->_fingerprintOrder = new FingerprintOrder();

        //if no config was sent fallback to default config file
        if (is_null($config)) {
            $config = Module::getConfig();
        }

        if (is_array($config) && isset( $config['QentaCEEQMoreConfig'] )) {
            // we only need the QentaCEEQMoreConfig here
            $config = $config['QentaCEEQMoreConfig'];
        }

        // let's store configuration details in internal objects
        $this->oUserConfig = is_object($config) ? $config : new Config($config);
        $this->oClientConfig = new Config(Module::getClientConfig());

        // now let's check if the CUSTOMER_ID, SHOP_ID, LANGUAGE and SECRET
        // exist in $this->oUserConfig object that we created from config array
        $sCustomerId = isset( $this->oUserConfig->CUSTOMER_ID ) ? trim($this->oUserConfig->CUSTOMER_ID) : null;
        $sShopId     = isset( $this->oUserConfig->SHOP_ID ) ? trim($this->oUserConfig->SHOP_ID) : null;
        $sLanguage   = isset( $this->oUserConfig->LANGUAGE ) ? trim($this->oUserConfig->LANGUAGE) : null;
        $sSecret     = isset( $this->oUserConfig->SECRET ) ? trim($this->oUserConfig->SECRET) : null;
        $sPassword   = isset( $this->oUserConfig->PASSWORD ) ? trim($this->oUserConfig->PASSWORD) : null;

        // If not throw the InvalidArgumentException exception!
        if (empty( $sCustomerId ) || is_null($sCustomerId)) {
            throw new InvalidArgumentException(sprintf('CUSTOMER_ID passed to %s is invalid.',
                __METHOD__));
        }

        if (empty( $sLanguage ) || is_null($sLanguage)) {
            throw new InvalidArgumentException(sprintf('LANGUAGE passed to %s is invalid.',
                __METHOD__));
        }

        if (empty( $sSecret ) || is_null($sSecret)) {
            throw new InvalidArgumentException(sprintf('SECRET passed to %s is invalid.',
                __METHOD__));
        }

        if (empty( $sPassword ) || is_null($sPassword)) {
            throw new InvalidArgumentException(sprintf('PASSWORD passed to %s is invalid.',
                __METHOD__));
        }

        // everything ok! let's set the fields
        $this->_setField(self::CUSTOMER_ID, $sCustomerId);
        $this->_setField(self::SHOP_ID, $sShopId);
        $this->_setField(self::LANGUAGE, $sLanguage);
        $this->_setField(self::PASSWORD, $sPassword);

        $this->_setSecret($sSecret);
    }

    public function getFinancialInstitutions($paymentType, $bankCountry = null, $transactionType = 'ONLINE')
    {
        $this->_requestData[self::COMMAND] = self::$COMMAND_GET_FINANCIAL_INSTITUTIONS;
        $this->_setField(self::PAYMENTTYPE, $paymentType);

        $order = Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::PASSWORD,
            self::SECRET,
            self::LANGUAGE,
            self::PAYMENTTYPE,
        );

        if (strlen($transactionType)) {
            $this->_setField(self::TRANSACTIONTYPE, $transactionType);
            $order[] = self::TRANSACTIONTYPE;
        }

        if (strlen($bankCountry)) {
            $this->_setField(self::BANKCOUNTRY, $bankCountry);
            $order[] = self::BANKCOUNTRY;
        }

        $this->_fingerprintOrder->setOrder($order);

        return new GetFinancialInstitutions($this->_send());
    }

    /**
     * Refund
     *
     * @throws InvalidResponseException
     * @return Refund
     */
    public function refund($iOrderNumber, $iAmount, $sCurrency, $basket=null)
    {
        $this->_requestData[self::COMMAND] = self::$COMMAND_REFUND;

        $this->_setField(self::ORDER_NUMBER, $iOrderNumber);
        $this->_setField(self::AMOUNT, $iAmount);
        $this->_setField(self::CURRENCY, strtoupper($sCurrency));
        $this->_setBasket($basket);

        $this->_fingerprintOrder->setOrder(Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::PASSWORD,
            self::SECRET,
            self::LANGUAGE,
            self::ORDER_NUMBER,
            self::AMOUNT,
            self::CURRENCY
        ));
        $this->_appendBasketFingerprintOrder($basket);

        return new Refund($this->_send());
    }

    /**
     * Refund reversal
     *
     * @throws InvalidResponseException
     * @return RefundReversal
     */
    public function refundReversal($iOrderNumber, $iCreditNumber)
    {
        $this->_requestData[self::COMMAND] = self::$COMMAND_REFUND_REVERSAL;

        $this->_setField(self::ORDER_NUMBER, $iOrderNumber);
        $this->_setField(self::CREDIT_NUMBER, $iCreditNumber);

        $this->_fingerprintOrder->setOrder(Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::PASSWORD,
            self::SECRET,
            self::LANGUAGE,
            self::ORDER_NUMBER,
            self::CREDIT_NUMBER
        ));

        return new RefundReversal($this->_send());
    }

    /**
     * Recur payment
     *
     * @throws InvalidResponseException
     * @return RecurPayment
     */
    public function recurPayment(
        $iSourceOrderNumber,
        $iAmount,
        $sCurrency,
        $sOrderDescription,
        $iOrderNumber = null,
        $bDepositFlag = null
    ) {
        $this->_requestData[self::COMMAND] = self::$COMMAND_RECUR_PAYMENT;

        if (!is_null($iOrderNumber)) {
            $this->_setField(self::ORDER_NUMBER, $iOrderNumber);
        }

        $this->_setField(self::SOURCE_ORDER_NUMBER, $iSourceOrderNumber);
        $this->_setField(self::AMOUNT, $iAmount);
        $this->_setField(self::CURRENCY, strtoupper($sCurrency));

        if (!is_null($bDepositFlag)) {
            $this->_setField(self::AUTO_DEPOSIT, $bDepositFlag ? self::$BOOL_TRUE : self::$BOOL_FALSE);
        }

        $this->_setField(self::ORDER_DESCRIPTION, $sOrderDescription);

        $this->_fingerprintOrder->setOrder(Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::PASSWORD,
            self::SECRET,
            self::LANGUAGE,
            self::ORDER_NUMBER,
            self::SOURCE_ORDER_NUMBER,
            self::AUTO_DEPOSIT,
            self::ORDER_DESCRIPTION,
            self::AMOUNT,
            self::CURRENCY
        ));

        return new RecurPayment($this->_send());
    }

    /**
     * Returns order details
     *
     * @param int $iOrderNumber
     *
     * @throws InvalidResponseException
     * @return GetOrderDetails
     */
    public function getOrderDetails($iOrderNumber)
    {
        $this->_requestData[self::COMMAND] = self::$COMMAND_GET_ORDER_DETAILS;
        $this->_setField(self::ORDER_NUMBER, $iOrderNumber);

        $this->_fingerprintOrder->setOrder(Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::PASSWORD,
            self::SECRET,
            self::LANGUAGE,
            self::ORDER_NUMBER
        ));

        return new GetOrderDetails($this->_send());
    }

    /**
     * Approve reversal
     *
     * @throws InvalidResponseException
     * @return ApproveReversal
     */
    public function approveReversal($iOrderNumber)
    {
        $this->_requestData[self::COMMAND] = self::$COMMAND_APPROVE_REVERSAL;
        $this->_setField(self::ORDER_NUMBER, $iOrderNumber);

        $this->_fingerprintOrder->setOrder(Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::PASSWORD,
            self::SECRET,
            self::LANGUAGE,
            self::ORDER_NUMBER
        ));

        return new ApproveReversal($this->_send());
    }

    /**
     * Deposit
     *
     * @throws InvalidResponseException
     * @return Deposit
     */
    public function deposit($iOrderNumber, $iAmount, $sCurrency, $basket=null)
    {
        $this->_requestData[self::COMMAND] = self::$COMMAND_DEPOSIT;

        $this->_setField(self::ORDER_NUMBER, $iOrderNumber);
        $this->_setField(self::AMOUNT, $iAmount);
        $this->_setField(self::CURRENCY, strtoupper($sCurrency));
        $this->_setBasket($basket);

        $this->_fingerprintOrder->setOrder(Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::PASSWORD,
            self::SECRET,
            self::LANGUAGE,
            self::ORDER_NUMBER,
            self::AMOUNT,
            self::CURRENCY
        ));
        $this->_appendBasketFingerprintOrder($basket);

        return new Deposit($this->_send());
    }

    /**
     * Deposit reversal
     *
     * @throws InvalidResponseException
     * @return DepositReversal
     */
    public function depositReversal($iOrderNumber, $iPaymentNumber)
    {
        $this->_requestData[self::COMMAND] = self::$COMMAND_DEPOSIT_REVERSAL;

        $this->_setField(self::ORDER_NUMBER, $iOrderNumber);
        $this->_setField(self::PAYMENT_NUMBER, $iPaymentNumber);

        $this->_fingerprintOrder->setOrder(Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::PASSWORD,
            self::SECRET,
            self::LANGUAGE,
            self::ORDER_NUMBER,
            self::PAYMENT_NUMBER
        ));

        return new DepositReversal($this->_send());
    }

    /**
     * TransferFund
     *
     * @throws InvalidTypeException
     * @return TransferFund
     */
    public function transferFund($fundTransferType)
    {

        switch ($fundTransferType) {
            case self::$TRANSFER_FUND_TYPE_EXISTING:
                $client = new Existing($this->oUserConfig);
                break;

            case self::$TRANSFER_FUND_TYPE_SKIRLLWALLET:
                $client = new SkrillWallet($this->oUserConfig);
                break;

            case self::$TRANSFER_FUND_TYPE_MONETA:
                $client = new Moneta($this->oUserConfig);
                break;

            case self::$TRANSFER_FUND_TYPE_SEPACT:
                $client = new SepaCT($this->oUserConfig);
                break;

            default:
                throw new InvalidTypeException('Invalid fundTransferType');
        }

        $client->setType($fundTransferType);

        return $client;
    }

    /**
     * *******************
     * PROTECTED METHODS *
     * *******************
     */

    /**
     * Backend URL for POST-Requests
     *
     * @see QentaCEE\Stdlib\Client\ClientAbstract::_getRequestUrl()
     * @return string
     */
    protected function _getRequestUrl()
    {
        return $this->oClientConfig->BACKEND_URL . "/" . $this->_getField(self::COMMAND);
    }

    /**
     * getter for given field
     *
     * @param string $name
     *
     * @return string|null
     */
    protected function _getField($name)
    {
        return array_key_exists($name, $this->_requestData) ? $this->_requestData[$name] : null;
    }

    /**
     * Returns the user agent string
     *
     * @return string
     */
    protected function _getUserAgent()
    {
        return "{$this->oClientConfig->MODULE_NAME};{$this->oClientConfig->MODULE_VERSION}";
    }
}