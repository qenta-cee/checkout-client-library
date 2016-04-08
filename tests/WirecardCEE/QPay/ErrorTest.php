<?php
/*
 * Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig. Software & Service Copyright (C) by Wirecard Central Eastern
* Europe GmbH, FB-Nr: FN 195599 x, http://www.wireacard.at
*/

/**
 * WirecardCEE_QPayFrontendClient test case.
 */
class WirecardCEE_QPay_ErrorTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @var WirecardCEE_QPay_Error
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new WirecardCEE_QPay_Error('WirecardCEE Error Message');
    }

    public function testGetMessage()
    {
        $this->assertEquals('WirecardCEE Error Message', $this->object->getMessage());
    }
}