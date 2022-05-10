<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Corte Model
 *
 * @property \App\Model\Table\BarberoTable&\Cake\ORM\Association\BelongsTo $Barbero
 * @property \App\Model\Table\CalificacionCorteTable&\Cake\ORM\Association\HasMany $CalificacionCorte
 * @property \App\Model\Table\ReservaTable&\Cake\ORM\Association\HasMany $Reserva
 *
 * @method \App\Model\Entity\Corte newEmptyEntity()
 * @method \App\Model\Entity\Corte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Corte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Corte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Corte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Corte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Corte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Corte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Corte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Corte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Corte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Corte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Corte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CorteTable extends Table
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

        $this->setTable('corte');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Barbero', [
            'foreignKey' => 'barbero_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('CalificacionCorte', [
            'foreignKey' => 'corte_id',
        ]);
        $this->hasMany('Reserva', [
            'foreignKey' => 'corte_id',
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
            ->scalar('nombre')
            ->maxLength('nombre', 50)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 500)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        $validator
            ->scalar('imagen')
            ->maxLength('imagen', 500)
            ->requirePresence('imagen', 'create')
            ->notEmptyFile('imagen');

        $validator
            ->integer('precio')
            ->requirePresence('precio', 'create')
            ->notEmptyString('precio');

        $validator
            ->time('tiempo_estimado')
            ->requirePresence('tiempo_estimado', 'create')
            ->notEmptyTime('tiempo_estimado');

        $validator
            ->integer('tipo')
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

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
