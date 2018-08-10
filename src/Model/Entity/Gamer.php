<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gamer Entity
 *
 * @property string $id
 * @property string $gamer_identity
 * @property string $gamer_fullname
 * @property int $gamer_day_birth
 * @property int $gamer_month_birth
 * @property string $gamer_category
 * @property string $gamer_details
 * @property bool $gamer_is_active
 * @property string $created_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\GamerCard[] $gamer_cards
 * @property \App\Model\Entity\Raffle[] $raffles
 */
class Gamer extends Entity
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
        'gamer_identity' => true,
        'gamer_fullname' => true,
        'gamer_day_birth' => true,
        'gamer_month_birth' => true,
        'gamer_category' => true,
        'gamer_details' => true,
        'gamer_is_active' => true,
        'created_by' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'gamer_cards' => true,
        'raffles' => true
    ];
}
