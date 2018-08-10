<?php

use Phinx\Migration\AbstractMigration;

class Raffles extends AbstractMigration
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
       $table = $this->table('raffles',['id'=>false, 'primary_key'=>['id']]);
        $table->addColumn('id','uuid')
        ->addColumn('created_by','uuid')
        ->addColumn('created','datetime')
        ->addColumn('modified','datetime')
        ->addColumn('raffle_details','text')
        ->addColumn('raffle_identity','string',['limit'=>100])
        ->addColumn('gamer_id','uuid',['null'=>true])
        ->addForeignKey('gamer_id','gamers','id',['delete'=>'CASCADE','update'=>'CASCADE']);
        $table->create();

    }
}
