<?php

use Phinx\Migration\AbstractMigration;
use Cake\Database\Connection;
use Cake\Utility\Text;
use Cake\Core\Configure;
use Cake\Database\Driver\Mysql;

class FlushRoleContents extends AbstractMigration
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
        $driver = new Mysql([
            'database' => 'gamecenter',
            'username' => 'root',
            'password' => 'root'
        ]);
        $connection = new Connection([
            'driver' => $driver
        ]);
        $statement = $connection->execute('SELECT * FROM roles');
        while($row = $statement->fetch('assoc')){
            $role_denomination = $row['role_denomination'];
            $now = new \DateTime();
            $now_formatted = $now->format('Y-m-d H:i:s');
            $migrations = [];
            switch($role_denomination){
                case 'Gerant':
                break;
                case 'Gestionnaire':
                $manager_forbidden_roles = [
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Bloquer Utilisateur",
                        "role_id" => $row["id"],
                        "content_action" => "/accounts/lock",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Déverouiller Utilisateur",
                        "role_id" => $row["id"],
                        "content_action" => "/accounts/unlock",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Ajout Gamer",
                        "role_id" => $row['id'],
                        "content_action" => "/gamers/create",
                        "content_controller" => "Gamers",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Ajout Passage",
                        "role_id" => $row['id'],
                        "content_action" => "/crossings/create",
                        "content_controller" => "Gamers",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Créer Tombola",
                        "role_id" => $row['id'],
                        "content_action" => "/raffles/create",
                        "content_controller" => "Gamers",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ]
                ];
                $this->table('role_contents')->insert($manager_forbidden_roles)->save();
                break;

                case 'Assistant':
                $assistant_forbidden_roles = [
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Créer Utilisateur",
                        "role_id" => $row['id'],
                        "content_action" => "/accounts/create",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Modifier Utilisateur",
                        "role_id" => $row['id'],
                        "content_action" => "/accounts/edit",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Bloquer Utilisateur",
                        "role_id" => $row['id'],
                        "content_action" => "/accounts/lock",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Déverouiller Utilisateur",
                        "role_id" => $row["id"],
                        "content_action" => "/accounts/unlock",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Ajout Gamer",
                        "role_id" => $row['id'],
                        "content_action" => "/gamers/create",
                        "content_controller" => "Gamers",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Ajout Passage",
                        "role_id" => $row['id'],
                        "content_action" => "/crossings/create",
                        "content_controller" => "Gamers",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Créer Tombola",
                        "role_id" => $row['id'],
                        "content_action" => "/raffles/create",
                        "content_controller" => "Gamers",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ]
                ];
                $this->table('role_contents')->insert($assistant_forbidden_roles)->save();
                break;

                case 'Caissiere':
                $caissiere_forbidden_roles = [
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Créer Utilisateur",
                        "role_id" => $row['id'],
                        "content_action" => "/accounts/create",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Modifier Utilisateur",
                        "role_id" => $row['id'],
                        "content_action" => "/accounts/edit",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Bloquer Utilisateur",
                        "role_id" => $row['id'],
                        "content_action" => "/accounts/lock",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Déverouiller Utilisateur",
                        "role_id" => $row["id"],
                        "content_action" => "/accounts/unlock",
                        "content_controller" => "Accounts",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Bloquer Gamer",
                        "role_id" => $row['id'],
                        "content_action" => "/gamers/lock",
                        "content_controller" => "Gamers",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Modifier Passage",
                        "role_id" => $row['id'],
                        "content_action" => "/crossings/update",
                        "content_controller" => "Gamers",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ],
                    [
                        'id'=>Text::uuid(),
                        "content_alias" => "Créer Tombola",
                        "role_id" => $row['id'],
                        "content_action" => "/raffles/create",
                        "content_controller" => "Gamers",
                        "created" => $now_formatted,
                        "modified" => $now_formatted
                    ]
                ];
                $this->table('role_contents')->insert($caissiere_forbidden_roles)->save();
                break;
            }
        }
    }

    public function down(){
         $this->execute('DELETE FROM role_contents');
    }
}
