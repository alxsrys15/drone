<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LibUserRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LibUserRolesTable Test Case
 */
class LibUserRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LibUserRolesTable
     */
    public $LibUserRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LibUserRoles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LibUserRoles') ? [] : ['className' => LibUserRolesTable::class];
        $this->LibUserRoles = TableRegistry::getTableLocator()->get('LibUserRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LibUserRoles);

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
