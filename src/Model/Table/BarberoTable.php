<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Barbero Model
 *
 * @property \App\Model\Table\CalificacionClienteTable&\Cake\ORM\Association\HasMany $CalificacionCliente
 * @property \App\Model\Table\CorteTable&\Cake\ORM\Association\HasMany $Corte
 * @property \App\Model\Table\HorarioBarberoTable&\Cake\ORM\Association\HasMany $HorarioBarbero
 * @property \App\Model\Table\ListaNegraTable&\Cake\ORM\Association\HasMany $ListaNegra
 * @property \App\Model\Table\BarbershopTable&\Cake\ORM\Association\BelongsToMany $Barbershop
 *
 * @method \App\Model\Entity\Barbero newEmptyEntity()
 * @method \App\Model\Entity\Barbero newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Barbero[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Barbero get($primaryKey, $options = [])
 * @method \App\Model\Entity\Barbero findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Barbero patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Barbero[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Barbero|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Barbero saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Barbero[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Barbero[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Barbero[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Barbero[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BarberoTable extends Table
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

        $this->setTable('barbero');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('CalificacionCliente', [
            'foreignKey' => 'barbero_id',
        ]);
        $this->hasMany('Corte', [
            'foreignKey' => 'barbero_id',
        ]);
        $this->hasMany('HorarioBarbero', [
            'foreignKey' => 'barbero_id',
        ]);
        $this->hasMany('ListaNegra', [
            'foreignKey' => 'barbero_id',
        ]);
        $this->belongsToMany('Barbershop', [
            'foreignKey' => 'barbero_id',
            'targetForeignKey' => 'barbershop_id',
            'joinTable' => 'barbero_barbershop',
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
            ->scalar('usuario')
            ->maxLength('usuario', 50)
            ->requirePresence('usuario', 'create')
            ->notEmptyString('usuario');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 120)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');

            $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->notBlank('clave');

            $validator
            ->scalar('clave')
            ->maxLength('clave', 255)
            ->requirePresence('clave', 'create')
            ->notEmptyString('clave')
            ->notBlank('clave')
            ->add('clave', [
        'length' => [
            'rule' => ['minLength', 4],
            'message' => 'La contraseña debe tener mínimo 4 carácteres.',
        ]
    ]);

        $validator
            ->sameAs('confirmar_clave', 'clave', 'Las contraseñas no coinciden!');

        $validator
            ->scalar('imagen_perfil')
            ->allowEmptyFile('imagen_perfil');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 9)
            ->allowEmptyString('tel');

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->allowEmptyString('token');

        return $validator;
    }
}
