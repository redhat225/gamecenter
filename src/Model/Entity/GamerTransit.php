<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GamerTransit Entity
 *
 * @property \Cake\I18n\FrozenTime $created
 * @property string $id
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $transit_identity
 * @property int $transit_amount
 * @property int $transit_value
 * @property int $transit_coins
 * @property int $transit_bonus
 * @property string $user_account_id
 * @property string $gamer_card_id
 *
 * @property \App\Model\Entity\UserAccount $user_account
 * @property \App\Model\Entity\GamerCard $gamer_card
 * @property \App\Model\Entity\GamerTransitTrace[] $gamer_transit_traces
 */
class GamerTransit extends Entity
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
        'created' => true,
        'modified' => true,
        'transit_identity' => true,
        'transit_amount' => true,
        'transit_value' => true,
        'transit_coins' => true,
        'transit_bonus' => true,
        'user_account_id' => true,
        'gamer_card_id' => true,
        'user_account' => true,
        'gamer_card' => true,
        'transit_extra_info' => true,
        'gamer_transit_traces' => true
    ];
}
