<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GamerCardsFixture
 *
 */
class GamerCardsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'card_identity' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'deleted' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'gamer_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'gamer_id' => ['type' => 'index', 'columns' => ['gamer_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'card_identity' => ['type' => 'unique', 'columns' => ['card_identity'], 'length' => []],
            'gamer_cards_ibfk_1' => ['type' => 'foreign', 'columns' => ['gamer_id'], 'references' => ['gamers', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'id' => 'd543df57-243a-41c6-9486-d744014ca2d8',
                'card_identity' => 'Lorem ipsum dolor sit amet',
                'created' => '2018-07-30 21:27:15',
                'modified' => '2018-07-30 21:27:15',
                'deleted' => '2018-07-30 21:27:15',
                'created_by' => '5b68afd0-5438-4b7c-9945-1a02505272e5',
                'gamer_id' => 'c43f675a-34fd-475e-9130-a7c133ebf8b6'
            ],
        ];
        parent::init();
    }
}
