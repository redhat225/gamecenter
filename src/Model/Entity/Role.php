<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property string $id
 * @property string $role_denomination
 * @property \Cake\I18n\FrozenTime $created
 * @property string $created_by
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\RoleContent[] $role_contents
 * @property \App\Model\Entity\UserAccount[] $user_accounts
 */
class Role extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'role_denomination' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'role_contents' => true,
        'user_accounts' => true
    ];
}
