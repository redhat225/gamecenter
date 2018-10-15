<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoleContent Entity
 *
 * @property string $id
 * @property string $content_alias
 * @property string $role_id
 * @property string $content_action
 * @property string $content_controller
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\RoleContentDynamic[] $role_content_dynamics
 */
class RoleContent extends Entity
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
        'content_alias' => true,
        'role_id' => true,
        'content_action' => true,
        'content_controller' => true,
        'created' => true,
        'modified' => true,
        'role_content_dynamics' => true
    ];
}
