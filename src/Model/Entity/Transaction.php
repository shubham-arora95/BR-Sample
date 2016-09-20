<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity.
 *
 * @property int $id
 * @property int $request_id
 * @property int $book_id
 * @property \App\Model\Entity\Book $book
 * @property int $status
 * @property int $owner_id
 * @property \App\Model\Entity\User $owner
 * @property int $borrower_id
 * @property \App\Model\Entity\User $borrower
 * @property \Cake\I18n\Time $issue_date
 * @property \Cake\I18n\Time $return_date
 * @property string $random
 * @property \App\Model\Entity\Request[] $requests
 */
class Transaction extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
