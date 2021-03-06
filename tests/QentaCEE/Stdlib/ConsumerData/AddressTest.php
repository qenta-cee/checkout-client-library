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

/**
 * Test class for QentaCEE_Client_QPay_Request_Initiation_ConsumerData_Address.
 * Generated by PHPUnit on 2011-06-24 at 13:17:12.
 */
use PHPUnit\Framework\TestCase;

class QentaCEE_Stdlib_ConsumerData_AddressTest extends TestCase
{

    /**
     * @var QentaCEE_Stdlib_ConsumerData_Address
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new QentaCEE\Stdlib\ConsumerData\Address(QentaCEE\Stdlib\ConsumerData\Address::TYPE_SHIPPING);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {

    }

    public function testSetFirstname()
    {
        $firstname = 'Unit';
        $this->object->setFirstname($firstname);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingFirstname', $data);
        $this->assertEquals($firstname, $data['consumerShippingFirstname']);
    }

    public function testSetLastname()
    {
        $lastname = 'Test';
        $this->object->setLastname($lastname);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingLastname', $data);
        $this->assertEquals($lastname, $data['consumerShippingLastname']);
    }

    public function testSetAddress1()
    {
        $address1 = 'Teststreet 1';
        $this->object->setAddress1($address1);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingAddress1', $data);
        $this->assertEquals($address1, $data['consumerShippingAddress1']);
    }

    public function testSetAddress2()
    {
        $address2 = 'Teststreet 2';
        $this->object->setAddress2($address2);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingAddress2', $data);
        $this->assertEquals($address2, $data['consumerShippingAddress2']);
    }

    public function testSetCity()
    {
        $city = 'TestCity';
        $this->object->setCity($city);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingCity', $data);
        $this->assertEquals($city, $data['consumerShippingCity']);
    }

    public function testSetCountry()
    {
        $country = 'TestCountry';
        $this->object->setCountry($country);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingCountry', $data);
        $this->assertEquals($country, $data['consumerShippingCountry']);
    }

    public function testSetState()
    {
        $state = 'State';
        $this->object->setState($state);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingState', $data);
        $this->assertEquals($state, $data['consumerShippingState']);
    }

    public function testSetZipCode()
    {
        $zipCode = '1234';
        $this->object->setZipCode($zipCode);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingZipCode', $data);
        $this->assertEquals($zipCode, $data['consumerShippingZipCode']);
    }

    public function testSetPhone()
    {
        $phone = '0123456789';
        $this->object->setPhone($phone);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingPhone', $data);
        $this->assertEquals($phone, $data['consumerShippingPhone']);
    }

    public function testSetFax()
    {
        $fax = '0123456789';
        $this->object->setFax($fax);
        $data = $this->object->getData();
        $this->assertArrayHasKey('consumerShippingFax', $data);
        $this->assertEquals($fax, $data['consumerShippingFax']);
    }

    public function testGetData()
    {
        $data = $this->object->getData();
        $this->assertIsArray($data);
    }

}

?>
