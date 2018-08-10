<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Raffle Entity
 *
 * @property string $id
 * @property string $created_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $raffle_details
 * @property string $raffle_identity
 * @property string $gamer_id
 *
 * @property \App\Model\Entity\Gamer $gamer
 */
class Raffle extends Entity
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
        'created_by' => true,
        'created' => true,
        'modified' => true,
        'raffle_details' => true,
        'raffle_identity' => true,
        'gamer_id' => true,
        'gamer' => true
    ];
}
