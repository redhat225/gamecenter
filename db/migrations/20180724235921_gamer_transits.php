<?php

use Phinx\Migration\AbstractMigration;

class GamerTransits extends AbstractMigration
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
        $table = $this->table('gamer_transits',['id'=>false, 'primary_key'=>['id']]);
        $table->addColumn('created','datetime')
              ->addColumn('id','uuid')
              ->addColumn('modified','datetime')
              ->addColumn('transit_identity','string',['limit'=>100])
              ->addColumn('transit_amount','integer',['limit'=>10])
              ->addColumn('transit_value','integer',['limit'=>10])
              ->addColumn('transit_coins','integer',['limit'=>10])
              ->addColumn('transit_bonus','integer',['limit'=>10,'null'=>true])
              ->addColumn('user_account_id','uuid')
              ->addColumn('gamer_card_id','uuid')
              ->addForeignKey('gamer_card_id','gamer_cards','id',['update'=>'CASCADE','delete'=>'CASCADE'])
              ->addForeignKey('user_account_id','user_accounts','id',['update'=>'CASCADE','delete'=>'CASCADE'])
              ->addIndex('transit_identity',['unique'=>true]);
        $table->create();

    }
}
