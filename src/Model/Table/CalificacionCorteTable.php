<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CalificacionCorte Model
 *
 * @property \App\Model\Table\ClienteTable&\Cake\ORM\Association\BelongsTo $Cliente
 * @property \App\Model\Table\CorteTable&\Cake\ORM\Association\BelongsTo $Corte
 *
 * @method \App\Model\Entity\CalificacionCorte newEmptyEntity()
 * @method \App\Model\Entity\CalificacionCorte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CalificacionCorte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CalificacionCorte get($primaryKey, $options = [])
 * @method \App\Model\Entity\CalificacionCorte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CalificacionCorte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CalificacionCorte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CalificacionCorte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CalificacionCorte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CalificacionCorte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CalificacionCorte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CalificacionCorte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CalificacionCorte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CalificacionCorteTable extends Table
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

        $this->setTable('calificacion_corte');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Cliente', [
            'foreignKey' => 'cliente_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Corte', [
            'foreignKey' => 'corte_id',
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
            ->integer('cliente_id')
            ->requirePresence('cliente_id', 'create')
            ->notEmptyString('cliente_id');

        $validator
            ->integer('corte_id')
            ->requirePresence('corte_id', 'create')
            ->notEmptyString('corte_id');

        $validator
            ->integer('calificacion')
            ->requirePresence('calificacion', 'create')
            ->notEmptyString('calificacion');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 500)
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('foto')
            ->maxLength('foto', 500)
            ->allowEmptyString('foto');

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
        $rules->add($rules->existsIn('cliente_id', 'Cliente'), ['errorField' => 'cliente_id']);
        $rules->add($rules->existsIn('corte_id', 'Corte'), ['errorField' => 'corte_id']);

        return $rules;
    }
}
