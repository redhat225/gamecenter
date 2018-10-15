<?php

use Phinx\Migration\AbstractMigration;
use Cake\Utility\Text;
use Cake\Core\Configure;

class FlushUsers extends AbstractMigration
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
        //insert user
        $table = $this->table('users');
        $user_id_1 = Text::uuid();
        $user_id_2 = Text::uuid();
        $now = new \DateTime();
        $now_formatted = $now->format('Y-m-d H:i:s');

        $users = [
            ["id" => $user_id_1,
            "user_fullname" => "RIEHL Emmanuel",
            "user_sexe" => "H",
            "user_contact" => "87853436",
            "user_email" => "riehlemm@gmail.com",
            "user_photo" => "riehl.png",
            "user_job" => "Ingénieur Sécurité",
            "created" => $now_formatted,
            "modified" => $now_formatted]
        ];


        $table->insert($users);
        $table->saveData();

        //insert role
        $table = $this->table('roles');
        $system_role = Text::uuid();
        $roles = [
            [
                "id" => $system_role,
                "role_denomination" => "System",
                "created" => $now_formatted,
                "modified" => $now_formatted,
                "created_by" => $user_id_1,
            ],
            [
                "id" => Text::uuid(),
                "role_denomination" => "Gerant",
                "created" => $now_formatted,
                "modified" => $now_formatted,
                "created_by" => $user_id_1,
            ],
            [
                "id" => Text::uuid(),
                "role_denomination" => "Gestionnaire",
                "created" => $now_formatted,
                "modified" => $now_formatted,
                "created_by" => $user_id_1,
            ],
            [
                "id" => Text::uuid(),
                "role_denomination" => "Assistant",
                "created" => $now_formatted,
                "modified" => $now_formatted,
                "created_by" => $user_id_1,
            ],
            [
                "id" => Text::uuid(),
                "role_denomination" => "Caissiere",
                "created" => $now_formatted,
                "modified" => $now_formatted,
                "created_by" => $user_id_1,
            ],
        ];

        $table->insert($roles);
        $table->saveData();

        //insert useraccount
        $table = $this->table('user_accounts');

        $user_accounts = [
            ["id" => Text::uuid(),
            "username" => "remmanuel225",
            "password" => '$2y$10$fvMsIN8Y9kbPa1MpqT1ogO7NNw6W/eL6nCJBV8WRmKUgEiROs3uXu',
            "user_avatar" => "riehl_avatar.png",
            "user_is_active" => true,
            "created_by" => $user_id_1,
            "created" => $now_formatted,
            "modified" => $now_formatted,
            "user_id" => $user_id_1,
            "role_id" => $system_role]
        ];

        $table->insert($user_accounts);
        $table->saveData();

        // insert role_contents
        // $table = $this->table('role_contents');
        // $role_contents = [
        //     [
        //         'id'=> 
        //         'content_alias'=>
        //         'content_action'=>
        //         'content_controller'=>
        //         'created'=> $now_formatted
        //         'modified'=> $now_formatted
        //     ]
        // ]
    }

    public function down(){
         $this->execute('DELETE FROM users');
         $this->execute('DELETE FROM user_accounts');
         $this->execute('DELETE FROM roles');
    }
}
