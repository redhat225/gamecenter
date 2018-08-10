<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GamerTransitTrace Entity
 *
 * @property string $id
 * @property string $trace_type
 * @property string $trace_info
 * @property string $created_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $gamer_transit_id
 *
 * @property \App\Model\Entity\GamerTransit $gamer_transit
 */
class GamerTransitTrace extends Entity
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
        'trace_type' => true,
        'trace_info' => true,
        'created_by' => true,
        'created' => true,
        'modified' => true,
        'gamer_transit_id' => true,
        'gamer_transit' => true
    ];
}
