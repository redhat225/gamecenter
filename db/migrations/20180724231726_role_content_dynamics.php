<?php

use Phinx\Migration\AbstractMigration;

class RoleContentDynamics extends AbstractMigration
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
        $table =$this->table('role_content_dynamics',['id'=>false, 'primary_key'=>['id']]);
        $table->addColumn('id','uuid')
        ->addColumn('role_content_id','uuid')
        ->addColumn('role_id','uuid')
        ->addColumn('created','datetime')
        ->addColumn('modified','datetime')
        ->addColumn('created_by','uuid')
        ->addForeignKey('role_id','roles','id',['delete'=>'CASCADE','update'=>'CASCADE'])
        ->addForeignKey('role_content_id','role_contents','id',['delete'=>'CASCADE','update'=>'CASCADE']);
        $table->create();
    }
}
