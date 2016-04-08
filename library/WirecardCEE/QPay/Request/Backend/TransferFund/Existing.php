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
 * @package  WirecardCEE_QMore
 * @version 3.2.0
 */
class WirecardCEE_QPay_Request_Backend_TransferFund_Existing extends WirecardCEE_QPay_Request_Backend_TransferFund
{

    public function send($amount, $currency, $orderDescription, $sourceOrderNumber)
    {
        $this->_setField(self::AMOUNT, $amount);
        $this->_setField(self::CURRENCY, $currency);
        $this->_setField(self::ORDER_DESCRIPTION, $orderDescription);
        $this->_setField(self::SOURCE_ORDER_NUMBER, $sourceOrderNumber);

        $orderArray = Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::TOOLKIT_PASSWORD,
            self::SECRET,
            self::COMMAND,
            self::LANGUAGE
        );
        if ($this->_getField(self::ORDER_NUMBER) !== null)
        {
            $orderArray[] = self::ORDER_NUMBER;
        }

        if ($this->_getField(self::CREDIT_NUMBER) !== null)
        {
            $orderArray[] = self::CREDIT_NUMBER;
        }

        $orderArray[] = self::ORDER_DESCRIPTION;
        $orderArray[] = self::AMOUNT;
        $orderArray[] = self::CURRENCY;

        if ($this->_getField(self::ORDER_REFERENCE) !== null)
        {
            $orderArray[] = self::ORDER_REFERENCE;
        }

        if ($this->_getField(self::CUSTOMER_STATEMENT) !== null)
        {
            $orderArray[] = self::CUSTOMER_STATEMENT;
        }

        $orderArray[] = self::FUNDTRANSFERTYPE;
        $orderArray[] = self::SOURCE_ORDER_NUMBER;

        $this->_fingerprintOrder->setOrder($orderArray);

        return new WirecardCEE_QPay_Response_Toolkit_TransferFund($this->_send());
    }
}