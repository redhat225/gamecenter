<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GamerTransitsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GamerTransitsTable Test Case
 */
class GamerTransitsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GamerTransitsTable
     */
    public $GamerTransits;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.gamer_transits',
        'app.user_accounts',
        'app.gamer_cards',
        'app.gamer_transit_traces'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GamerTransits') ? [] : ['className' => GamerTransitsTable::class];
        $this->GamerTransits = TableRegistry::get('GamerTransits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GamerTransits);

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
