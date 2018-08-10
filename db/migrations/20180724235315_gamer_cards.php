<?php

use Phinx\Migration\AbstractMigration;

class GamerCards extends AbstractMigration
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
        $table = $this->table('gamer_cards',['id'=>false, 'primary_key'=>['id']]);
        $table->addColumn('id','uuid')
        ->addColumn('card_identity','string',['limit'=>100])
        ->addColumn('created','datetime')
        ->addColumn('modified','datetime')
        ->addColumn('deleted','datetime',['null'=>true])
        ->addColumn('created_by','uuid')
        ->addColumn('gamer_id','uuid')
        ->addForeignKey('gamer_id','gamers','id',['update'=>'CASCADE','delete'=>'CASCADE'])
        ->addIndex('card_identity',['unique'=>true]);

        $table->create();


    }
}
