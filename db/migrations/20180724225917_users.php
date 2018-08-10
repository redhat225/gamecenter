<?php

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('users',['id'=>false, 'primary_key'=>['id']]);
        $table->addColumn('id','uuid')
              ->addColumn('user_fullname','string',['limit'=>100])
              ->addColumn('user_sexe','char',['length'=>1])
              ->addColumn('user_email','string',['limit'=>100])
              ->addColumn('user_photo','text')
              ->addColumn('user_contact','char',['length'=>8])
              ->addColumn('user_job','text')
              ->addColumn('created','datetime')
              ->addColumn('modified','datetime')
              ->addIndex('user_email',['unique'=>true]);
        $table->create();
    }
}
