<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GamerCard Entity
 *
 * @property string $id
 * @property string $card_identity
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 * @property string $created_by
 * @property string $gamer_id
 *
 * @property \App\Model\Entity\CardGamer $card_gamer
 * @property \App\Model\Entity\Gamer $gamer
 * @property \App\Model\Entity\GamerTransit[] $gamer_transits
 */
class GamerCard extends Entity
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
        'card_identity' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'created_by' => true,
        'gamer_id' => true,
        'card_gamer' => true,
        'gamer' => true,
        'gamer_transits' => true
    ];
}
