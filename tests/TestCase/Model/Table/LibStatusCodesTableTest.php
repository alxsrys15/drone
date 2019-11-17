<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LibStatusCodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LibStatusCodesTable Test Case
 */
class LibStatusCodesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LibStatusCodesTable
     */
    public $LibStatusCodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LibStatusCodes',
        'app.Orders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LibStatusCodes') ? [] : ['className' => LibStatusCodesTable::class];
        $this->LibStatusCodes = TableRegistry::getTableLocator()->get('LibStatusCodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LibStatusCodes);

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
