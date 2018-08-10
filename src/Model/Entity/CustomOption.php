<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomOption Entity
 *
 * @property string $id
 * @property string $option_details
 * @property int $option_current_coin_value
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class CustomOption extends Entity
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
        'option_details' => true,
        'option_current_coin_value' => true,
        'created' => true,
        'modified' => true
    ];
}
