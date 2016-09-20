<?php
namespace App\Test\TestCase\Controller;

use App\Controller\BooksController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\BooksController Test Case
 */
class BooksControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.books',
        'app.users',
        'app.book_transactions',
        'app.posts',
        'app.reviews',
        'app.requests',
        'app.transactions',
        'app.owners',
        'app.borrowers'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test borrow method
     *
     * @return void
     */
    public function testBorrow()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test generateRequest method
     *
     * @return void
     */
    public function testGenerateRequest()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test myAddedBooks method
     *
     * @return void
     */
    public function testMyAddedBooks()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test searchbook method
     *
     * @return void
     */
    public function testSearchbook()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test issued method
     *
     * @return void
     */
    public function testIssued()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test borrowed method
     *
     * @return void
     */
    public function testBorrowed()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
