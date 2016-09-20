<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookTransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookTransactionsTable Test Case
 */
class BookTransactionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BookTransactionsTable
     */
    public $BookTransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.book_transactions',
        'app.users',
        'app.posts',
        'app.books',
        'app.reviews'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BookTransactions') ? [] : ['className' => 'App\Model\Table\BookTransactionsTable'];
        $this->BookTransactions = TableRegistry::get('BookTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BookTransactions);

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
