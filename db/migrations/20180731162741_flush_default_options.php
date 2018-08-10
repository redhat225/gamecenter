<?php
use Cake\Utility\Text;
use Phinx\Migration\AbstractMigration;

class FlushDefaultOptions extends AbstractMigration
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
public function up()
    {
        //insert default options
        $table = $this->table('custom_options');
        $now = new \DateTime();
        $now_formatted = $now->format('Y-m-d H:i:s');

        $options = [
            [
                "id" => Text::uuid(),
                "option_details" => null,
                "option_current_coin_value" => 500,
                "created" => $now_formatted,
                "modified" => $now_formatted,
            ]
        ];
        $table->insert($options);
        $table->saveData();
    }

    public function down(){
         $this->execute('DELETE FROM custom_options');
    }
}
