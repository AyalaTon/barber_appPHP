<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoCorte Model
 *
 * @method \App\Model\Entity\TipoCorte newEmptyEntity()
 * @method \App\Model\Entity\TipoCorte newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TipoCorte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoCorte get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoCorte findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TipoCorte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoCorte[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoCorte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoCorte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoCorte[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TipoCorte[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TipoCorte[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TipoCorte[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TipoCorteTable extends Table
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

        $this->setTable('tipo_corte');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('nombre')
            ->maxLength('nombre', 50)
            ->allowEmptyString('nombre');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 500)
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('imagen')
            ->maxLength('imagen', 500)
            ->allowEmptyFile('imagen');

        return $validator;
    }
}
