<?php

namespace Reservat\Manager;

use Reservat\Core\Interfaces\ManagerInterface;
use Reservat\Repository\CustomerRepository;
use Reservat\Datamapper\CustomerDatamapper;
use Reservat\Customer;

class CustomerManager implements ManagerInterface
{

	public function __construct($di)
	{
		$this->repository = new CustomerRepository($di->get('db'));
        $this->datamapper = new CustomerDatamapper($di->get('db'));
	}

	public function getRepository()
	{
		return $this->repository;
	}
    
    public function getDatamapper()
    {
    	return $this->datamapper;
    }

    public function getEntity(...$args) 
    {
    	return new Customer(...$args);
    }
}