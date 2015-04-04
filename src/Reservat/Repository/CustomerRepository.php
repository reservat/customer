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
        $data = $this->query(array('id' => $id), 1);

        if($data->execute(array($id))) {
            $this->records[] = $data->fetch(\PDO::FETCH_ASSOC);
        }

        return $this;
    }

    /**
     * Fetch all and potentially in-house-cache the results.
     *
     * @param int $limit
     * @return array
     */
    public function getAll($limit = 20)
    {
        $data = $this->query(array(), $limit);

        if($data->execute()) {
            foreach($data->fetchAll(\PDO::FETCH_ASSOC) as $row) {
                $this->records[] = $row;
            }
        }

        return $this;
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