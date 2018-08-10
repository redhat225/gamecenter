<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoleContentDynamic Entity
 *
 * @property string $id
 * @property string $role_content_id
 * @property string $role_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $created_by
 *
 * @property \App\Model\Entity\RoleContent $role_content
 * @property \App\Model\Entity\Role $role
 */
class RoleContentDynamic extends Entity
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
        'role_content_id' => true,
        'role_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'role_content' => true,
        'role' => true
    ];
}
