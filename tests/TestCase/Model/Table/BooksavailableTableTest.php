<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BooksavailableTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BooksavailableTable Test Case
 */
class BooksavailableTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BooksavailableTable
     */
    public $Booksavailable;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.booksavailable'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Booksavailable') ? [] : ['className' => 'App\Model\Table\BooksavailableTable'];
        $this->Booksavailable = TableRegistry::get('Booksavailable', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Booksavailable);

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
