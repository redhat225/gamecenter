<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GamerCardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GamerCardsTable Test Case
 */
class GamerCardsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GamerCardsTable
     */
    public $GamerCards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.gamer_cards',
        'app.card_gamers',
        'app.gamers',
        'app.gamer_transits'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GamerCards') ? [] : ['className' => GamerCardsTable::class];
        $this->GamerCards = TableRegistry::get('GamerCards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GamerCards);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
