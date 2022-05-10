<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BarberoBarbershop Model
 *
 * @property \App\Model\Table\BarberoTable&\Cake\ORM\Association\BelongsTo $Barbero
 * @property \App\Model\Table\BarbershopTable&\Cake\ORM\Association\BelongsTo $Barbershop
 *
 * @method \App\Model\Entity\BarberoBarbershop newEmptyEntity()
 * @method \App\Model\Entity\BarberoBarbershop newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BarberoBarbershop[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BarberoBarbershop get($primaryKey, $options = [])
 * @method \App\Model\Entity\BarberoBarbershop findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BarberoBarbershop patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BarberoBarbershop[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BarberoBarbershop|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BarberoBarbershop saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BarberoBarbershop[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BarberoBarbershop[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BarberoBarbershop[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BarberoBarbershop[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BarberoBarbershopTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('barbero_barbershop');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Barbero', [
            'foreignKey' => 'barbero_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Barbershop', [
            'foreignKey' => 'barbershop_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('barbero_id')
            ->requirePresence('barbero_id', 'create')
            ->notEmptyString('barbero_id')
            ->add('barbero_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('barbershop_id')
            ->requirePresence('barbershop_id', 'create')
            ->notEmptyString('barbershop_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('barbero_id', 'Barbero'), ['errorField' => 'barbero_id']);
        $rules->add($rules->existsIn('barbershop_id', 'Barbershop'), ['errorField' => 'barbershop_id']);

        return $rules;
    }
}
