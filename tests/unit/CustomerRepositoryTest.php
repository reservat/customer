<?php

class CustomerRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \PDO
     */
    protected $pdo = null;

    /**
     * @var Reservat\Datamapper\CustomerDatamapper
     */
    protected $mapper = null;

    /**
     * @var \Reservat\Repository\CustomerRepository
     */
    protected $repo = null;

    /**
     * Create PDO instance and schema to test against
     */
    protected function setUp()
    {
        // Schema
        $schema =<<<SQL
        CREATE TABLE "customer" (
        "id" INTEGER PRIMARY KEY,
        "forename" VARCHAR NOT NULL,
        "surname" VARCHAR NOT NULL,
        "telephone" VARCHAR NOT NULL,
        "email" VARCHAR
        );
SQL;

        // DB
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec($schema);

        // Dependencies
        $this->mapper = new Reservat\Datamapper\CustomerDatamapper($this->pdo);
        $this->repo = new \Reservat\Repository\CustomerRepository($this->pdo);
    }

    public function testGetRowCount()
    {
        $this->assertCount(0, $this->repo);
    }

    public function testAdd()
    {
        $customer = new \Reservat\Customer('Luke', 'Steadman', '01234567890', 'luke@steadman.com');
        $this->mapper->insert($customer);
        $this->assertCount(1, $this->repo->getAll());
    }

    public function testUpdate()
    {
        $customer = new \Reservat\Customer('Luke', 'Steadman', '01234567890', 'luke@steadman.com');
        $this->mapper->insert($customer);

        $customer->setForename('Luke John');
        $this->mapper->update($customer, 1);
        $customerUpdated = $this->repo->getById(1)->current();

        $this->assertEquals('Luke John', $customerUpdated['forename']);
    }

    public function testBadInsert()
    {
        try {
            $customer = new \Reservat\Customer(null, null, null, null);
            $this->mapper->save($customer);
        } catch (\Exception $e) {
            $this->assertCount(0, $this->repo->getAll());
        }
    }

    public function testSaveInsert()
    {
        $customer = new \Reservat\Customer('Luke', 'Steadman', '01234567890', 'luke@steadman.com');
        $this->mapper->save($customer);

        $savedCustomer = $this->repo->getById(1)->current();

        $this->assertEquals('Luke', $savedCustomer['forename']);
    }

    public function testSaveUpdate()
    {
        $customer = new \Reservat\Customer('Luke', 'Steadman', '01234567890', 'luke@steadman.com');
        $this->mapper->save($customer);

        $customer->setForename('Luke John');
        $this->mapper->save($customer, 1);

        $savedCustomer = $this->repo->getById(1)->current();

        $this->assertEquals('Luke John', $savedCustomer['forename']);
    }

    public function testRemove()
    {
        $customer = new \Reservat\Customer('Paul', 'Westerdale', '01234567890', 'paul@westerdale.com');

        $this->mapper->insert($customer);
        $this->mapper->delete($customer, 1);

        $this->assertCount(0, $this->repo->getAll());
    }
} 