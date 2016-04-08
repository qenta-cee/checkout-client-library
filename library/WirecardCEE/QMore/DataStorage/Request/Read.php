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
 * @name WirecardCEE_QMore_DataStorage_Request_Read
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage DataStorage_Request
 * @version 3.2.0
 */
class WirecardCEE_QMore_DataStorage_Request_Read extends WirecardCEE_Stdlib_Client_ClientAbstract
{
    /**
     * Storage ID field name
     *
     * @var string
     */
    const STORAGE_ID = "storageId";

    /**
     *
     * @var int
     */
    protected $_fingerprintOrderType = 1;

    /**
     * Constructor
     *
     * @param array $aConfig
     *
     * @throws WirecardCEE_QMore_Exception_InvalidArgumentException
     */
    public function __construct($aConfig = null)
    {
        $this->_fingerprintOrder = new WirecardCEE_Stdlib_FingerprintOrder();

        //if no config was sent fallback to default config file
        if (is_null($aConfig)) {
            $aConfig = WirecardCEE_QMore_Module::getConfig();
        }

        if (isset( $aConfig['WirecardCEEQMoreConfig'] )) {
            //we only need the WirecardCEEQMoreConfig here
            $aConfig = $aConfig['WirecardCEEQMoreConfig'];
        }

        //let's store configuration details in internal objects
        $this->oUserConfig   = new WirecardCEE_Stdlib_Config($aConfig);
        $this->oClientConfig = new WirecardCEE_Stdlib_Config(WirecardCEE_QMore_Module::getClientConfig());

        //now let's check if the CUSTOMER_ID, SHOP_ID, LANGUAGE and SECRET exist in $this->oUserConfig object that we created from config array
        $sCustomerId = isset( $this->oUserConfig->CUSTOMER_ID ) ? trim($this->oUserConfig->CUSTOMER_ID) : null;
        $sShopId     = isset( $this->oUserConfig->SHOP_ID ) ? trim($this->oUserConfig->SHOP_ID) : null;
        $sLanguage   = isset( $this->oUserConfig->LANGUAGE ) ? trim($this->oUserConfig->LANGUAGE) : null;
        $sSecret     = isset( $this->oUserConfig->SECRET ) ? trim($this->oUserConfig->SECRET) : null;


        //If not throw the InvalidArgumentException exception!
        if (empty( $sCustomerId ) || is_null($sCustomerId)) {
            throw new WirecardCEE_QMore_DataStorage_Exception_InvalidArgumentException(sprintf('CUSTOMER_ID passed to %s is invalid.',
                __METHOD__));
        }

        if (empty( $sLanguage ) || is_null($sLanguage)) {
            throw new WirecardCEE_QMore_DataStorage_Exception_InvalidArgumentException(sprintf('LANGUAGE passed to %s is invalid.',
                __METHOD__));
        }

        if (empty( $sSecret ) || is_null($sSecret)) {
            throw new WirecardCEE_QMore_DataStorage_Exception_InvalidArgumentException(sprintf('SECRET passed to %s is invalid.',
                __METHOD__));
        }

        //everything ok! let's set the fields
        $this->_setField(self::CUSTOMER_ID, $sCustomerId);
        $this->_setField(self::SHOP_ID, $sShopId);
        $this->_setField(self::LANGUAGE, $sLanguage);
        $this->_setSecret($sSecret);
    }

    /**
     *
     * @param mixed $storageId
     *
     * @return WirecardCEE_QMore_DataStorage_Response_Read
     */
    public function read($storageId)
    {
        $this->_setField(self::STORAGE_ID, $storageId);

        $this->_fingerprintOrder->setOrder(Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::STORAGE_ID,
            self::SECRET
        ));

        return new WirecardCEE_QMore_DataStorage_Response_Read($this->_send());
    }

    /**
     * @see WirecardCEE_Stdlib_Client_ClientAbstract::_getRequestUrl()
     * @return string
     */
    protected function _getRequestUrl()
    {
        return $this->oClientConfig->DATA_STORAGE_URL . '/read';
    }

    /**
     * Returns the user agent string
     *
     * @return string
     */
    protected function _getUserAgent()
    {
        return (string) "{$this->oClientConfig->MODULE_NAME};{$this->oClientConfig->MODULE_VERSION}";
    }
}