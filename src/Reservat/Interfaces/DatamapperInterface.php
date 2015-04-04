<?php 

namespace Reservat\Interfaces;

interface DatamapperInterface
{
    /**
     * Return the name of the table we're interacting with
     *
     * @return string
     */
    public function table();
    public function insert(EntityInterface $entity);
    public function update(EntityInterface $entity, $id);
    public function save(EntityInterface $entity, $id = null);
    public function delete(EntityInterface $entity, $id);
}