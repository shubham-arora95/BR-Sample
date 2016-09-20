<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $writer
 * @property string $edition
 * @property string $course
 * @property string $description
 * @property float $price
 * @property int $status
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $photo
 * @property \App\Model\Entity\BookTransaction[] $book_transactions
 * @property \App\Model\Entity\Request[] $requests
 * @property \App\Model\Entity\Review[] $reviews
 * @property \App\Model\Entity\Transaction[] $transactions
 */
class Book extends Entity
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
