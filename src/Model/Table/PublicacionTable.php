<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Publicacion Model
 *
 * @property \App\Model\Table\BarbershopTable&\Cake\ORM\Association\BelongsTo $Barbershop
 *
 * @method \App\Model\Entity\Publicacion newEmptyEntity()
 * @method \App\Model\Entity\Publicacion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Publicacion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Publicacion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Publicacion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Publicacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Publicacion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Publicacion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Publicacion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Publicacion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Publicacion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Publicacion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Publicacion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PublicacionTable extends Table
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

        $this->setTable('publicacion');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
            ->integer('barbershop_id')
            ->requirePresence('barbershop_id', 'create')
            ->notEmptyString('barbershop_id');

        $validator
            ->scalar('contenido')
            ->maxLength('contenido', 500)
            ->requirePresence('contenido', 'create')
            ->notEmptyString('contenido');

        $validator
            ->scalar('imagen')
            ->maxLength('imagen', 500)
            ->allowEmptyFile('imagen');

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
        $rules->add($rules->existsIn('barbershop_id', 'Barbershop'), ['errorField' => 'barbershop_id']);

        return $rules;
    }
}
