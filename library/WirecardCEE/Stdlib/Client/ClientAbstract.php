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

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

/**
 * @name WirecardCEE_Stdlib_Client_ClientAbstract
 * @category WirecardCEE
 * @package WirecardCEE_Stdlib
 * @subpackage Client
 * @version 3.2.0
 * @abstract
 */
abstract class WirecardCEE_Stdlib_Client_ClientAbstract {

    /**
     * Secret holder
     *
     * @var string
     */
    protected $_secret;

    /**
     * HTTP Client
     *
     * @var GuzzleHttp\Client
     */
    protected $_httpClient;

    /**
     *
     * @var string
     */
    protected $userAgent;

    /**
     * Fingerprint order type (dynamic or fixed)
     *
     * @var int
     */
    protected $_fingerprintOrderType = 0;

    /**
     * Fingerprint
     *
     * @var string
     */
    protected $_fingerprintString = null;

    /**
     * Fingeprint order
     *
     * @var WirecardCEE_Stdlib_FingerprintOrder
     */
    protected $_fingerprintOrder;

    /**
     * request data
     *
     * @var string[]
     */
    protected $_requestData;

    /**
     * Request path
     *
     * @var string
     */
    protected $_requestPath = '';

    /**
     * User configuration holder!
     *
     * @var WirecardCEE_Stdlib_Config
     */
    protected $oUserConfig;

    /**
     * Client configuration holder!
     *
     * @var WirecardCEE_Stdlib_Config
     */
    protected $oClientConfig;

    /**
     * Bool true
     * @var string
     */
    protected static $BOOL_TRUE = 'yes';

    /**
     * BOol false
     * @var string
     */
    protected static $BOOL_FALSE = 'no';

    /**
     * Dynamic fingerprint
     * @var int
     */
    protected static $FINGERPRINT_TYPE_DYNAMIC = 0;

    /**
     * Fixed fingerprint
     * @var int
     */
    protected static $FINGERPRINT_TYPE_FIXED = 1;

    /**
     * Field names variable: customer_id
     * @var string
     */
    const CUSTOMER_ID = 'customerId';

    /**
     * Field names variable: secret
     * @var string
     */
    const SECRET = 'secret';

    /**
     * Field names variable: language
     * @var string
     */
    const LANGUAGE = 'language';

    /**
     * Field names variable: shopId
     * @var string
     */
    const SHOP_ID = 'shopId';

    /**
     * Field names variable: requestFingerprintOrder
     * @var string
     */
    const REQUEST_FINGERPRINT_ORDER = 'requestFingerprintOrder';

    /**
     * Field names variable: requestFingerprint
     * @var string
     */
    const REQUEST_FINGERPRINT = 'requestFingerprint';

    /**
     * Field names variable: amount
     * @var string
     */
    const AMOUNT = 'amount';

    /**
     * Field names variable: currency
     * @var string
     */
    const CURRENCY = 'currency';

    /**
     * Field names variable: orderDescription
     * @var string
     */
    const ORDER_DESCRIPTION = 'orderDescription';

    /**
     * Field names variable: autoDeposit
     * @var string
     */
    const AUTO_DEPOSIT = 'autoDeposit';

    /**
     * Field names variable: orderNumber
     * @var string
     */
    const ORDER_NUMBER = 'orderNumber';

    /**
     * Field names variable: transactionIdentifier
     * @var string
     */
    const TX_IDENT = 'transactionIdentifier';

    /**
     * Must be implemented in the client object
     *
     * @param array|WirecardCEE_Stdlib_Config $aConfig
     * @abstract
     */
    abstract public function __construct($aConfig = null);

    /**
     * setter for Guzzle Http Client.
     * Use this if you need specific client-configuration.
     * otherwise the clientlibrary instantiates the http client on its own.
     *
     * @param $httpClient
     * @return WirecardCEE_Stdlib_Client_ClientAbstract
     */
    public function setHttpClient($httpClient) {
        $this->_httpClient = $httpClient;
        return $this;
    }

    /**
     * private getter for the Guzzle Http Client
     * if not set yet it will be instantiated
     *
     * @return GuzzleHttp\Client
     */
    protected function _getHttpClient() {
        if (is_null($this->_httpClient)) {
            // @todo implement SSL check here
            $this->_httpClient =  new GuzzleHttp\Client();
        }

        return $this->_httpClient;
    }


    /**
     * Returns the user configuration object
     *
     * @return WirecardCEE_Stdlib_Config
     */
    public function getUserConfig() {
        return $this->oUserConfig;
    }

    /**
     * Returns the client configuration object
     *
     * @return WirecardCEE_Stdlib_Config
     */
    public function getClientConfig() {
        return $this->oClientConfig;
    }

    /**
     * Returns the user agent string
     *
     * @return string
     */
    public function getUserAgentString() {
        $oClientConfig = new WirecardCEE_Stdlib_Config(WirecardCEE_Stdlib_Module::getClientConfig());

        $sUserAgent = $this->_getUserAgent() . ";{$oClientConfig->MODULE_NAME};{$oClientConfig->MODULE_VERSION};";

        foreach($oClientConfig->DEPENDENCIES as $sValue) {
            $sUserAgent .= is_string($sValue) ? $sValue . ";" : $sValue->CURRENT . ";";
        }

        return $sUserAgent;
    }

    /**
     * Returns all the request data as an array
     * @return array
     */
    public function getRequestData() {
        return (array) $this->_requestData;
    }

    /**
     * Destructor
     */
    public function __destruct() {
        unset($this);
    }

    /**************************
     *   PROTECTED METHODS    *
     **************************/

    /**
     * Must be implemented in the client
     *
     * @return string
     * @abstract
     */
    abstract protected function _getRequestUrl();

    /**
     * Must be implemented in the client
     *
     * @return string
     * @abstract
     */
    abstract protected function _getUserAgent();

    /**
     * 'Secret' setter
     *
     * @param string $secret
     */
    protected function _setSecret($secret) {
        $this->_secret = $secret;
        $this->_fingerprintOrder[] = self::SECRET;
    }

    /**
     * sends the request and returns the zend http response object instance
     *
     * @throws WirecardCEE_Stdlib_Client_Exception_InvalidResponseException
     * @return ResponseInterface
     */
    protected function _send() {
        if (count($this->_fingerprintOrder)) {
            $this->_fingerprintString = $this->_calculateFingerprint();
            if (!is_null($this->_fingerprintString)) {
                $this->_requestData[self::REQUEST_FINGERPRINT] = $this->_fingerprintString;
            }
        }

        try {
            $response = $this->_sendRequest();
        }
        catch (RequestException $e) {
            throw new WirecardCEE_Stdlib_Client_Exception_InvalidResponseException($e->getMessage(), $e->getCode(), $e);
        }

        return $response;
    }

    /**
     * method to calculate fingerprint from given fields.
     *
     * @return string - fingerprint hash
     */
    protected function _calculateFingerprint() {
        $oFingerprintOrder = $this->_fingerprintOrder;

        if ($this->_fingerprintOrderType == self::$FINGERPRINT_TYPE_DYNAMIC) {
            // we have to add REQUESTFINGERPRINTORDER to local fingerprintOrder to add correct value to param list
            $oFingerprintOrder[] = self::REQUEST_FINGERPRINT_ORDER;
            $this->_requestData[self::REQUEST_FINGERPRINT_ORDER] = (string) $oFingerprintOrder;
        }
        // fingerprintFields == requestFields + secret - secret MUST NOT be send as param
        $fingerprintFields = $this->_requestData;
        $fingerprintFields[self::SECRET] = $this->_secret;

        return WirecardCEE_Stdlib_Fingerprint::generate($fingerprintFields, $oFingerprintOrder);
    }

    /**
     * Sends the request and returns the zend http response object instance
     *
     * @throws RequestException
     * @return ResponseInterface
     */
    protected function _sendRequest() {
        $httpClient = $this->_getHttpClient();

        $request = $httpClient->post($this->_getRequestUrl(), [
            'form_params' => $this->_requestData,
            'headers' => [
                'User-Agent' => $this->getUserAgentString()
            ]
        ]);

        return $request;
    }

    /**
     * Setter for requestfield.
     * Bare in mind that $this->_fingerprintOrder is an WirecardCEE_Stdlib_FingerprintOrder object which implements
     * the ArrayAccess interface meaning we can use the array annotation [] on an object
     *
     * @see WirecardCEE_Stdlib_FingerprintOrder
     * @param string $name
     * @param mixed $value
     */
    protected function _setField($name, $value) {
        $this->_requestData[(string) $name] = (string) $value;
        $this->_fingerprintOrder[] = (string) $name;
    }

    /**
     * Check if we the field is set in the _requestData array
     *
     * @param string $sFieldname
     * @return boolean
     */
    protected function _isFieldSet($sFieldname) {
        return (bool) (isset($this->_requestData[$sFieldname]) && !empty($this->_requestData[$sFieldname]));
    }

    protected function _composeCustomerStatement($paymenttype, $prefix = null, $uniqString = null)
    {
        if ($prefix === null)
            $prefix = 'Web Shop';

        $prefix = substr($prefix, 0, 9);

        if (!strlen($uniqString))
            $uniqString = $this->generateUniqString(10);

        if ($paymenttype == WirecardCEE_Stdlib_PaymentTypeAbstract::POLI)
        {
            $customerStatement = $prefix;
        } else {
            $customerStatement = sprintf('%s Id:%s', $prefix, $uniqString);
        }

        return $customerStatement;
    }

    /**
     * returns a uniq String with default length 10.
     *
     * @param int $length
     * @return string
     */
    public function generateUniqString($length = 10)
    {
        $tid = '';

        $alphabet = "023456789abcdefghikmnopqrstuvwxyzABCDEFGHIKMNOPQRSTUVWXYZ";

        for ($i = 0; $i < $length; $i++)
        {
            $c = substr($alphabet, mt_rand(0, strlen($alphabet) - 1), 1);

            if ((($i % 2) == 0) && !is_numeric($c))
            {
                $i--;
                continue;
            }
            if ((($i % 2) == 1) && is_numeric($c))
            {
                $i--;
                continue;
            }

            $alphabet = str_replace($c, '', $alphabet);
            $tid .= $c;
        }

        return $tid;
    }

}