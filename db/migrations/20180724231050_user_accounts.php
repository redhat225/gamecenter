<?php
use Phinx\Migration\AbstractMigration;

class UserAccounts extends AbstractMigration
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
        $table =$this->table('user_accounts',['id'=>false, 'primary_key'=>['id']]);
        $table->addColumn('id','uuid')
              ->addColumn('user_is_active','boolean')
              ->addColumn('password','text')
              ->addColumn('user_id','uuid')
              ->addColumn('role_id','uuid')
              ->addColumn('username','string',['limit'=>100])
              ->addColumn('user_avatar','text')
              ->addColumn('created_by','uuid')
              ->addColumn('created','timestamp')
              ->addColumn('modified','timestamp')
              ->addForeignKey('user_id','users','id',['delete'=>'CASCADE','update'=>'CASCADE'])
              ->addForeignKey('role_id','roles','id',['delete'=>'CASCADE','update'=>'CASCADE'])
              ->addIndex('username',['unique'=>true]);
        $table->create();
    }
}
