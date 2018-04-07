<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property string $id
 * @property string $user_fullname
 * @property string $user_sexe
 * @property string $user_email
 * @property string $user_photo
 * @property string $user_contact
 * @property string $user_job
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\UserAccount[] $user_accounts
 */
class User extends Entity
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
        'user_fullname' => true,
        'user_sexe' => true,
        'user_email' => true,
        'user_photo' => true,
        'user_contact' => true,
        'user_job' => true,
        'created' => true,
        'modified' => true,
        'user_accounts' => true
    ];
}
