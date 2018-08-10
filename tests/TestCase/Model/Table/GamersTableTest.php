<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GamersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GamersTable Test Case
 */
class GamersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GamersTable
     */
    public $Gamers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.gamers',
        'app.gamer_cards',
        'app.raffles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Gamers') ? [] : ['className' => GamersTable::class];
        $this->Gamers = TableRegistry::get('Gamers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Gamers);

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
     * Test beforeMarshal method
     *
     * @return void
     */
    public function testBeforeMarshal()
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
