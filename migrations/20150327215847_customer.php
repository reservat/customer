<?php

use Phinx\Migration\AbstractMigration;

class Customer extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('customer');
        $table
            ->addColumn('forename', 'string', array('limit' => 30))
            ->addColumn('surname', 'string', array('limit' => 30))
            ->addColumn('email', 'string', array('limit' => 100))
            ->addColumn('telephone', 'string', array('limit' => 20))
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create()
        ;
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('customer')->drop();
    }
}