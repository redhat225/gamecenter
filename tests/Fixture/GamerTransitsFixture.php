<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GamerTransitsFixture
 *
 */
class GamerTransitsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'transit_identity' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'transit_amount' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'transit_value' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'transit_coins' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'transit_bonus' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_account_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'gamer_card_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'gamer_card_id' => ['type' => 'index', 'columns' => ['gamer_card_id'], 'length' => []],
            'user_account_id' => ['type' => 'index', 'columns' => ['user_account_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'transit_identity' => ['type' => 'unique', 'columns' => ['transit_identity'], 'length' => []],
            'gamer_transits_ibfk_1' => ['type' => 'foreign', 'columns' => ['gamer_card_id'], 'references' => ['gamer_cards', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'gamer_transits_ibfk_2' => ['type' => 'foreign', 'columns' => ['user_account_id'], 'references' => ['user_accounts', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'created' => '2018-07-31 18:44:09',
                'id' => '10c495a4-3f17-409d-9e13-da8c9ead393a',
                'modified' => '2018-07-31 18:44:09',
                'transit_identity' => 'Lorem ipsum dolor sit amet',
                'transit_amount' => 1,
                'transit_value' => 1,
                'transit_coins' => 1,
                'transit_bonus' => 1,
                'user_account_id' => '93c59b77-902a-4f70-af39-f2cf393cd4a5',
                'gamer_card_id' => '8162dfa6-80c1-4d7e-8566-3c9b9ecbc09d'
            ],
        ];
        parent::init();
    }
}
