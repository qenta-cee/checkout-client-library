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
 * @name WirecardCEE_QMore_Request_Backend_TransferFund_Existing
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @version 3.2.0
 */
class WirecardCEE_QPay_Request_Backend_TransferFund extends WirecardCEE_QPay_ToolkitClient
{

    /**
     * fundTransferType.
     *
     * @var string
     */
    const FUNDTRANSFERTYPE = 'fundTransferType';


    public function __construct($config = null)
    {
        parent::__construct($config);
        $this->_requestData[self::COMMAND] = self::$COMMAND_TRANSFER_FUND;
    }

    /**
     * seter for fundTransferType field
     *
     * @param $fundTransferType
     */
    public function setType($fundTransferType)
    {
        $this->_requestData[self::FUNDTRANSFERTYPE] = $fundTransferType;
    }

    /**
     * seter for orderNumber field
     *
     * @param $orderNumber
     *
     * @return $this
     */
    public function setOrderNumber($orderNumber)
    {
        $this->_setField(self::ORDER_NUMBER, $orderNumber);
        return $this;
    }

    /**
     * seter for orderReference field
     *
     * @param $orderReference
     *
     * @return $this
     */
    public function setOrderReference($orderReference)
    {
        $this->_setField(self::ORDER_REFERENCE, $orderReference);
        return $this;
    }

    /**
     * seter for creditNumber field
     *
     * @param $creditNumber
     *
     * @return $this
     */
    public function setCreditNumber($creditNumber)
    {
        $this->_setField(self::CREDIT_NUMBER, $creditNumber);
        return $this;
    }

    /**
     * seter for customerStatement field
     *
     * @param $customerStatement
     *
     * @return $this
     */
    public function setCustomerStatement($customerStatement)
    {
        $this->_setField(self::CUSTOMER_STATEMENT, $customerStatement);
        return $this;
    }

}