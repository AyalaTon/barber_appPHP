<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ListaNegra Model
 *
 * @property \App\Model\Table\BarberoTable&\Cake\ORM\Association\BelongsTo $Barbero
 * @property \App\Model\Table\ClienteTable&\Cake\ORM\Association\BelongsTo $Cliente
 *
 * @method \App\Model\Entity\ListaNegra newEmptyEntity()
 * @method \App\Model\Entity\ListaNegra newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ListaNegra[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ListaNegra get($primaryKey, $options = [])
 * @method \App\Model\Entity\ListaNegra findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ListaNegra patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ListaNegra[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ListaNegra|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ListaNegra saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ListaNegra[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ListaNegra[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ListaNegra[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ListaNegra[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ListaNegraTable extends Table
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

        $this->setTable('lista_negra');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Barbero', [
            'foreignKey' => 'barbero_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cliente', [
            'foreignKey' => 'cliente_id',
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
            ->integer('cliente_id')
            ->requirePresence('cliente_id', 'create')
            ->notEmptyString('cliente_id');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 500)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        $validator
            ->boolean('estado')
            ->requirePresence('estado', 'create')
            ->notEmptyString('estado');

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
        $rules->add($rules->existsIn('cliente_id', 'Cliente'), ['errorField' => 'cliente_id']);

        return $rules;
    }
}
