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
 * @name WirecardCEE_QMore_Response_Initiation
 * @category WirecardCEE
 * @package WirecardCEE_QMore
 * @subpackage Response
 * @version 3.2.0
 */
class WirecardCEE_QMore_Response_Initiation extends WirecardCEE_QMore_Response_ResponseAbstract {

    /**
     * Returns the status of a response
     *
     * @return int
     */
    public function getStatus() {
        // if we have got a redirectUrl the initiation has been successful
        return ($this->_getField(self::REDIRECT_URL)) ? self::STATE_SUCCESS : self::STATE_FAILURE;
    }

}