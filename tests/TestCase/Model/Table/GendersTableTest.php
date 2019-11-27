<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GendersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GendersTable Test Case
 */
class GendersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GendersTable
     */
    public $Genders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Genders',
        'app.Products'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Genders') ? [] : ['className' => GendersTable::class];
        $this->Genders = TableRegistry::getTableLocator()->get('Genders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Genders);

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
