<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RafflesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RafflesTable Test Case
 */
class RafflesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RafflesTable
     */
    public $Raffles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.raffles',
        'app.gamers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Raffles') ? [] : ['className' => RafflesTable::class];
        $this->Raffles = TableRegistry::get('Raffles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Raffles);

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
