<?php

namespace Reservat\Test;

use \Reservat\Manager\CustomerManager;
use \Reservat\Customer;

use Aura\Di\Container;
use Aura\Di\Factory;

class CustomerManagerTest extends \PHPUnit_Framework_TestCase
{

    protected $di = null;

    protected $manager = null;

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
        
        $this->di = new Container(new Factory);

        $this->di->set('db', function () {
            return new \PDO('sqlite::memory:');
        });

        $this->di->get('db')->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->di->get('db')->exec($schema);

        $this->manager = new CustomerManager($this->di);

    }

    public function testMapperClass()
    {
        $this->assertInstanceOf('Reservat\\Repository\\CustomerRepository', $this->manager->getRepository());
        $this->assertInstanceOf('Reservat\\Datamapper\\CustomerDatamapper', $this->manager->getDatamapper());
        $this->assertInstanceOf('Reservat\\Customer', $this->manager->getEntity('Luke', 'Steadman', '01234567890'));
    }

}