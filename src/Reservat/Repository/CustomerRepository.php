<?php

namespace Reservat\Repository;

use Reservat\Interfaces\RepositoryInterface;

class CustomerRepository implements RepositoryInterface
{
    /**
     * @var null|\PDO
     */
    protected $db = null;

    /**
     * @var array
     */
    protected $records = array();

    /**
     * Inject an instance of PDO
     *
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Search for a record by ID
     *
     * @param $id
     * @param bool $cache
     * @return null
     */
    public function getById($id, $cache = false)
    {
        $data = $this->getAll(20, $cache);

        if(array_key_exists($id, $data)) {
            return $data[$id];
        }

        return null;
    }

    /**
     * Fetch all and potentially in-house-cache the results.
     *
     * @param int $limit
     * @param bool $cache
     * @return array
     */
    public function getAll($limit = 20, $cache = true)
    {
        if(!empty($this->records) && !$cache) {
            return $this->records;
        }

        $data = $this->query();

        if($data->execute()) {
            foreach($data->fetchAll(\PDO::FETCH_ASSOC) as $row) {
                $this->records[$row['id']] = $row;
            }
        }

        return $this->records;
    }

    /**
     * Perform a PDO query
     *
     * @param array $data
     * @param int $limit
     * @return bool
     */
    private function query($data = array(), $limit = 10)
    {
        $query = $this->selectQuery($data) . ' LIMIT ' . intval($limit);
        $db = $this->db->prepare($query);

        return $db;
    }

    /**
     * Build a generic select query up based on an array of data
     *
     * @param array $data
     * @return string
     */
    private function selectQuery(array $data)
    {
        $query = 'SELECT * FROM ' . $this->table();

        if(!empty($data)) {
            $query .= ' WHERE ';

            foreach($data as $column => $value) {
                $query .= $column . ' = ?';
            }
        }

        return $query;
    }

    /**
     * Return a the table name
     *
     * @return string
     */
    public function table()
    {
        return 'customer';
    }
}