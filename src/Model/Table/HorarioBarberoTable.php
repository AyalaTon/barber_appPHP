<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HorarioBarbero Model
 *
 * @property \App\Model\Table\BarberoTable&\Cake\ORM\Association\BelongsTo $Barbero
 *
 * @method \App\Model\Entity\HorarioBarbero newEmptyEntity()
 * @method \App\Model\Entity\HorarioBarbero newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\HorarioBarbero[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HorarioBarbero get($primaryKey, $options = [])
 * @method \App\Model\Entity\HorarioBarbero findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\HorarioBarbero patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HorarioBarbero[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HorarioBarbero|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HorarioBarbero saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HorarioBarbero[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HorarioBarbero[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HorarioBarbero[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HorarioBarbero[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class HorarioBarberoTable extends Table
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

        $this->setTable('horario_barbero');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Barbero', [
            'foreignKey' => 'barbero_id',
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
            ->notEmptyString('barbero_id');

        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDate('fecha');

        $validator
            ->time('hora_inicio')
            ->requirePresence('hora_inicio', 'create')
            ->notEmptyTime('hora_inicio');

        $validator
            ->time('hora_fin')
            ->requirePresence('hora_fin', 'create')
            ->notEmptyTime('hora_fin');

        $validator
            ->boolean('disponible')
            ->requirePresence('disponible', 'create')
            ->notEmptyString('disponible');

        $validator
            ->scalar('turno')
            ->maxLength('turno', 1)
            ->requirePresence('turno', 'create')
            ->notEmptyString('turno');

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

        return $rules;
    }
}
