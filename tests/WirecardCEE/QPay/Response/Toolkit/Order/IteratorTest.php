<?php

class WirecardCEE_QPay_Response_Toolkit_Order_OrderIteratorTestObject extends WirecardCEE_QPay_Response_Toolkit_Order_OrderIterator
{
}

/**
 * Test class for WirecardCEE_QPay_Response_Toolkit_Order_IteratorTest.
 * Generated by PHPUnit on 2011-06-24 at 13:26:18.
 */
class WirecardCEE_QPay_Response_Toolkit_Order_IteratorTest extends PHPUnit_Framework_TestCase
{


    /**
     * @var WirecardCEE_QPay_Response_Toolkit_Order_OrderIteratorTestObject
     */
    protected $object;

    public function setUp()
    {
        $data         = Array('a', 'b', 'c', 'd');
        $this->object = new WirecardCEE_QPay_Response_Toolkit_Order_OrderIteratorTestObject($data);
    }

    public function testCurrent()
    {
        $this->assertEquals('a', $this->object->current());
    }

    public function testNext()
    {
        $this->object->next();
        $this->assertEquals('b', $this->object->current());
    }

    public function testRewind()
    {
        $this->object->next();
        $this->object->next();
        $this->object->rewind();
        $this->assertEquals('a', $this->object->current());
    }

    public function testValid()
    {
        $this->assertTrue($this->object->valid());
        $this->object->next();
        $this->assertTrue($this->object->valid());
        $this->object->next();
        $this->assertTrue($this->object->valid());
        $this->object->next();
        $this->assertTrue($this->object->valid());
    }

    public function testNotValid()
    {
        $this->object->next();
        $this->object->next();
        $this->object->next();
        $this->object->next();
        $this->object->next();
        $this->assertFalse($this->object->valid());
    }

    public function testKey()
    {
        $this->object->next();
        $this->assertEquals('1', $this->object->key());
    }
}