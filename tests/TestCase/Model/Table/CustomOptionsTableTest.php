<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomOptionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomOptionsTable Test Case
 */
class CustomOptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomOptionsTable
     */
    public $CustomOptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.custom_options'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomOptions') ? [] : ['className' => CustomOptionsTable::class];
        $this->CustomOptions = TableRegistry::get('CustomOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomOptions);

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
}
