<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoleContentDynamicsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoleContentDynamicsTable Test Case
 */
class RoleContentDynamicsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoleContentDynamicsTable
     */
    public $RoleContentDynamics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.role_content_dynamics',
        'app.role_contents',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoleContentDynamics') ? [] : ['className' => RoleContentDynamicsTable::class];
        $this->RoleContentDynamics = TableRegistry::get('RoleContentDynamics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoleContentDynamics);

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
