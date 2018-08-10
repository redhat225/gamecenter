<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoleContentDynamicsFixture
 *
 */
class RoleContentDynamicsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'role_content_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'role_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'role_id' => ['type' => 'index', 'columns' => ['role_id'], 'length' => []],
            'role_content_id' => ['type' => 'index', 'columns' => ['role_content_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'role_content_dynamics_ibfk_1' => ['type' => 'foreign', 'columns' => ['role_id'], 'references' => ['roles', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'role_content_dynamics_ibfk_2' => ['type' => 'foreign', 'columns' => ['role_content_id'], 'references' => ['role_contents', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'id' => '8abe6265-62e7-4a90-b9ae-4c67d659da97',
                'role_content_id' => '94bd31e2-c9fd-4e25-b021-95e4c0972c70',
                'role_id' => 'fcb0a3c8-dfe9-46ba-80b0-8b19479748af',
                'created' => '2018-07-29 13:48:40',
                'modified' => '2018-07-29 13:48:40',
                'created_by' => '091c9313-19ef-4c18-b894-71d9b83c0508'
            ],
        ];
        parent::init();
    }
}
