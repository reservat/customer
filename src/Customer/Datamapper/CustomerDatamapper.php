<?php

namespace Customer\Datamapper;

use Customer\Interfaces\DatamapperInterface;
use Customer\Interfaces\EntityInterface;

class CustomerDatamapper implements DatamapperInterface
{
    /**
     * @var \PDO
     */
    protected $db = null;

    /**
     * Pass connection details through
     *
     * @param $host
     * @param $user
     * @param $pass
     * @param $db
     * @param $port
     * @param string $charset
     * @throws \PDOException
     */
    public function __construct($host, $user, $pass, $db, $port = null, $charset = 'utf8')
    {
        try
        {
            $this->db = new \PDO('mysql:host='.$host.';dbname='.$db.';charset='.$charset, $user, $pass);
        }
        catch(\PDOException $e)
        {
            // do something but throw the exception back
            throw $e;
        }
    }

    /**
     * Return the table name we're interacting with
     *
     * @return string
     */
    public function table()
    {
        return 'customer';
    }

    /**
     * Attempt to insert a record into the Customer Storage engine
     *
     * @param EntityInterface $entity
     */
    public function insert(EntityInterface $entity)
    {
        $params = trim(str_repeat('?,', count($entity->toArray())), ',');
        $query  = "INSERT INTO " . $this->table() . " (". implode(', ', array_keys($entity->toArray())).") ";
        $query .= "VALUES (".$params.")";

        $this->execute($query, array_values($entity->toArray()));
    }

    /**
     * Update the customer entity
     *
     * @param EntityInterface $entity
     * @param $id
     */
    public function update(EntityInterface $entity, $id)
    {
        $update = function() use($entity) {
            $sql = 'UPDATE ' . $this->table() . ' SET ';

            foreach($entity->toArray() as $key => $value) {
                $sql .= $key . ' = ' . '?, ';
            }

            $sql .= ' WHERE id = ?';

            return rtrim(trim($sql), ',');
        };

        $values = $entity->toArray() + array('id' => $id);

        $this->execute($update(), array_values($values));
    }

    /**
     * Attempt to update the Customer entity if the $id is passed, otherwise insert.
     *
     * @param EntityInterface $entity
     * @param null $id
     */
    public function save(EntityInterface $entity, $id = null)
    {
        if(!is_null($id)) {
            $this->update($entity, $id);
        } else {
            $this->insert($entity);
        }
    }

    /**
     * Attempt to delete the Customer entity
     *
     * @param EntityInterface $entity
     * @param $id
     */
    public function delete(EntityInterface $entity, $id)
    {
        $query = 'DELETE FROM ' . $this->table() . ' WHERE id = ?';
        $this->execute($query, array($id));
    }

    /**
     * Execute the query we build
     *
     * @param $query
     * @param $values
     * @return bool
     */
    private function execute($query, array $values)
    {
        $this->db->beginTransaction();

        if($this->db->prepare($query)->execute($values)) {
            $this->db->commit();
            return true;
        }

        $this->db->rollBack();
        return false;
    }
}