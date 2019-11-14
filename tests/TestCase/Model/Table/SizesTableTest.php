<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SizesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SizesTable Test Case
 */
class SizesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SizesTable
     */
    public $Sizes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Sizes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Sizes') ? [] : ['className' => SizesTable::class];
        $this->Sizes = TableRegistry::getTableLocator()->get('Sizes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sizes);

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
