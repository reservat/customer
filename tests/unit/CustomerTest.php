<?php

class CustomerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Reservat\Customer
     */
    protected $customer = null;

    public function setUp()
    {
        if(!$this->customer instanceof Customer) {
            $this->customer = new \Reservat\Customer('Luke', 'Steadman', '01234567890');
        }

        return $this->customer;
    }

    public function testGetCustomer()
    {
        // Getters
        $this->assertEquals('Luke', $this->customer->getForename());
        $this->assertEquals('Steadman', $this->customer->getSurname());
        $this->assertEquals('01234567890', $this->customer->getTelephone());

        // Interface
        $this->assertEquals('01234567890', $this->customer->getTelephoneNumber());
        $this->assertEquals('Luke Steadman', $this->customer->getFullName());
    }

    public function testSetCustomer()
    {
        $this->customer->setEmail('luke@steadman.com');
        $this->assertEquals('luke@steadman.com', $this->customer->getEmail());

        // Change customer details
        $this->customer->setForename('Paul');
        $this->customer->setSurname('Westerdale');
        $this->customer->setTelephone('9876543210');
        $this->customer->setEmail('paul@westerdale.com');

        $this->assertEquals('Paul', $this->customer->getForename());
        $this->assertEquals('Westerdale', $this->customer->getSurname());
        $this->assertEquals('9876543210', $this->customer->getTelephone());
        $this->assertEquals('9876543210', $this->customer->getTelephoneNumber());
        $this->assertEquals('paul@westerdale.com', $this->customer->getEmail());
    }

    public function testInstanceToArray()
    {
        $array = $this->customer->toArray();

        $this->assertInternalType('array', $array);
        $this->assertCount(4, $array);
    }
}

