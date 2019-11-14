<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductSizeStocksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductSizeStocksTable Test Case
 */
class ProductSizeStocksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductSizeStocksTable
     */
    public $ProductSizeStocks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProductSizeStocks',
        'app.Products',
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
        $config = TableRegistry::getTableLocator()->exists('ProductSizeStocks') ? [] : ['className' => ProductSizeStocksTable::class];
        $this->ProductSizeStocks = TableRegistry::getTableLocator()->get('ProductSizeStocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductSizeStocks);

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
