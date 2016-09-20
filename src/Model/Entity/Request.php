<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Request Entity.
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $book_id
 * @property \App\Model\Entity\Book $book
 * @property int $borrower_id
 * @property \App\Model\Entity\User $borrower
 * @property int $owner_id
 * @property \App\Model\Entity\User $owner
 * @property int $Weeks
 * @property int $ownerAck
 * @property bool $rentPaid
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $payment_date
 * @property \App\Model\Entity\Transaction[] $transactions
 */
class Request extends Entity
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
