<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BooksavailableFixture
 *
 */
class BooksavailableFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'booksavailable';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'title' => ['type' => 'string', 'length' => 265, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'writer' => ['type' => 'string', 'length' => 265, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'edition' => ['type' => 'string', 'length' => 265, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'course' => ['type' => 'string', 'length' => 265, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'price' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'is_borrowed' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'writer' => 'Lorem ipsum dolor sit amet',
            'edition' => 'Lorem ipsum dolor sit amet',
            'course' => 'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'price' => 1,
            'is_borrowed' => 1
        ],
    ];
}
