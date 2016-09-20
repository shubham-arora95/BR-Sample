<?php
namespace App\Model\Table;

use App\Model\Entity\Booksavailable;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Booksavailable Model
 *
 */
class BooksavailableTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('booksavailable');
        $this->displayField('title');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('writer', 'create')
            ->notEmpty('writer');

        $validator
            ->requirePresence('edition', 'create')
            ->notEmpty('edition');

        $validator
            ->requirePresence('course', 'create')
            ->notEmpty('course');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->boolean('is_borrowed')
            ->requirePresence('is_borrowed', 'create')
            ->notEmpty('is_borrowed');

        return $validator;
    }
}
