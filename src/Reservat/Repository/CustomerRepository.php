<?php

namespace Reservat\Repository;

use Reservat\Core\Repository\PDORepository;

class CustomerRepository extends PDORepository
{
    /**
     * Return a the table name.
     *
     * @return string
     */
    public function table()
    {
        return 'customer';
    }
}
