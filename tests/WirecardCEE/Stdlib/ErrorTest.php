<?php
/*
* Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig. Software & Service Copyright (C) by Wirecard Central Eastern
* Europe GmbH, FB-Nr: FN 195599 x, http://www.wireacard.at
*/

class WirecardCEE_Stdlib_ErrorTest_Mock extends WirecardCEE_Stdlib_Error {}

class WirecardCEE_Stdlib_ErrorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var WirecardCEE_Stdlib_ErrorTest_Mock
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new WirecardCEE_Stdlib_ErrorTest_Mock();
        $this->object->setMessage('testMessage');
        $this->object->setConsumerMessage('testConsumerMessage');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    public function testGetMessage() {
        $this->assertEquals('testMessage', $this->object->getMessage());
    }

    public function testGetConsumerMessage() {
        $this->assertEquals('testConsumerMessage', $this->object->getConsumerMessage());
    }
}

?>
