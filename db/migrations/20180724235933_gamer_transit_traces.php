<?php

use Phinx\Migration\AbstractMigration;

class GamerTransitTraces extends AbstractMigration
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
        $table = $this->table('gamer_transit_traces',['id'=>false, 'primary_key'=>['id']]);
        $table->addColumn('id','uuid')
        ->addColumn('trace_type','string',['limit'=>30])
        ->addColumn('trace_info','text')
        ->addColumn('created_by','uuid')
        ->addColumn('created','datetime')
        ->addColumn('modified','datetime')
        ->addColumn('gamer_transit_id','uuid')
        ->addForeignKey('gamer_transit_id','gamer_transits','id',['delete'=>'CASCADE','update'=>'CASCADE']);
        $table->create();
    }
}
