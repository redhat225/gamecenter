<?php

use Phinx\Migration\AbstractMigration;

class Gamers extends AbstractMigration
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
        $table = $this->table('gamers',['id'=>false, 'primary_key'=>['id']]);
        $table->addColumn('id','uuid')
              ->addColumn('gamer_identity','string',['limit'=>100])
              ->addColumn('gamer_fullname','string',['limit'=>100])
              ->addColumn('gamer_day_birth','integer',['limit'=>1])
              ->addColumn('gamer_month_birth','integer',['limit'=>1])
              ->addColumn('gamer_category','string',['limit'=>100])
              ->addColumn('gamer_details','text')
              ->addColumn('gamer_is_active','boolean')
              ->addColumn('created_by','uuid')
              ->addColumn('created','datetime')
              ->addColumn('modified','datetime')
              ->addColumn('deleted','datetime',['null'=>true])
              ->addIndex('gamer_identity',['unique'=>true]);
        $table->create();
    }
}
