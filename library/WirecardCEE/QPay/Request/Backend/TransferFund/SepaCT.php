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
 * @name WirecardCEE_QPay_Request_Backend_TransferFund_SkrillWallet
 * @category WirecardCEE
 * @version 3.2.0
 */
class WirecardCEE_QPay_Request_Backend_TransferFund_SepaCT extends WirecardCEE_QPay_Request_Backend_TransferFund
{

    public function send($amount, $currency, $orderDescription, $bankAccountOwner, $bankBic, $bankAccountIban)
    {
        $this->_setField(self::AMOUNT, $amount);
        $this->_setField(self::CURRENCY, $currency);
        $this->_setField(self::ORDER_DESCRIPTION, $orderDescription);
        //$this->_setField(self::CUSTOMER_STATEMENT, $customerStatement);
        $this->_setField(self::BANKACCOUNTOWNER, $bankAccountOwner);
        $this->_setField(self::BANKBIC, $bankBic);
        $this->_setField(self::BANKACCOUNTIBAN, $bankAccountIban);

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

        if ($this->_getField(self::ORDER_DESCRIPTION) !== null)
        {
            $orderArray[] = self::ORDER_DESCRIPTION;
        }
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
        $orderArray[] = self::BANKACCOUNTOWNER;
        $orderArray[] = self::BANKBIC;
        $orderArray[] = self::BANKACCOUNTIBAN;

        $this->_fingerprintOrder->setOrder($orderArray);

        return new WirecardCEE_QPay_Response_Toolkit_TransferFund($this->_send());
    }
}