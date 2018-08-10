<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GamerTransitTracesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GamerTransitTracesTable Test Case
 */
class GamerTransitTracesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GamerTransitTracesTable
     */
    public $GamerTransitTraces;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.gamer_transit_traces',
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
        $config = TableRegistry::exists('GamerTransitTraces') ? [] : ['className' => GamerTransitTracesTable::class];
        $this->GamerTransitTraces = TableRegistry::get('GamerTransitTraces', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GamerTransitTraces);

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
