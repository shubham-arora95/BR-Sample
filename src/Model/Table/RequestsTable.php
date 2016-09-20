<?php
namespace App\Model\Table;

use App\Model\Entity\Request;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requests Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Transactions
 * @property \Cake\ORM\Association\BelongsTo $Books
 * @property \Cake\ORM\Association\BelongsTo $Borrowers
 * @property \Cake\ORM\Association\BelongsTo $Owners
 * @property \Cake\ORM\Association\HasMany $Transactions
 */
class RequestsTable extends Table
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

        $this->table('requests');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Transactions', [
            'foreignKey' => 'transaction_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Books', [
            'foreignKey' => 'book_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Borrowers', [
            'className' => 'Users',
            'foreignKey' => 'borrower_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Owners', [
            'className' => 'Users',
            'foreignKey' => 'owner_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Transactions', [
            'foreignKey' => 'request_id'
        ]);
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
            ->integer('Weeks')
            ->requirePresence('Weeks', 'create')
            ->notEmpty('Weeks');

        $validator
            ->integer('ownerAck')
            ->requirePresence('ownerAck', 'create')
            ->notEmpty('ownerAck');

        $validator
            ->boolean('rentPaid')
            ->requirePresence('rentPaid', 'create')
            ->notEmpty('rentPaid');

        $validator
            ->dateTime('payment_date')
            ->requirePresence('payment_date', 'create')
            ->notEmpty('payment_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['transaction_id'], 'Transactions'));
        $rules->add($rules->existsIn(['book_id'], 'Books'));
        $rules->add($rules->existsIn(['borrower_id'], 'Borrowers'));
        $rules->add($rules->existsIn(['owner_id'], 'Owners'));
        return $rules;
    }
}
