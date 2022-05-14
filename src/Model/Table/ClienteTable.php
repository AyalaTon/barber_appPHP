<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cliente Model
 *
 * @property \App\Model\Table\CalificacionClienteTable&\Cake\ORM\Association\HasMany $CalificacionCliente
 * @property \App\Model\Table\CalificacionCorteTable&\Cake\ORM\Association\HasMany $CalificacionCorte
 * @property \App\Model\Table\ListaNegraTable&\Cake\ORM\Association\HasMany $ListaNegra
 * @property \App\Model\Table\ReservaTable&\Cake\ORM\Association\HasMany $Reserva
 *
 * @method \App\Model\Entity\Cliente newEmptyEntity()
 * @method \App\Model\Entity\Cliente newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Cliente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cliente get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cliente findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Cliente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cliente[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cliente|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cliente saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClienteTable extends Table
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

        $this->setTable('cliente');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('CalificacionCliente', [
            'foreignKey' => 'cliente_id',
        ]);
        $this->hasMany('CalificacionCorte', [
            'foreignKey' => 'cliente_id',
        ]);
        $this->hasMany('ListaNegra', [
            'foreignKey' => 'cliente_id',
        ]);
        $this->hasMany('Reserva', [
            'foreignKey' => 'cliente_id',
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
            ->notEmptyString('email');

        $validator
            ->scalar('clave')
            ->maxLength('clave', 18)
            ->requirePresence('clave', 'create')
            ->notEmptyString('clave');

        $validator
            ->sameAs('confirmar_clave', 'clave', 'Las contraseñas no coinciden!');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 9)
            ->allowEmptyString('tel');
        
            $validator
            ->scalar('imagen_perfil')
            ->allowEmptyFile('imagen_perfil')
            ->add('imagen_perfil', [
                'mimeType' => [
                    'rule' => ['mimeType', ['image/jpeg', 'image/png', 'image/jpg']],
                    'message' => 'Solo se aceptan imagenes jpg, jpeg y png',
                ],
                'fileSize' => [
                    'rule' => ['fileSize', '<=', '2MB'],
                    'message' => 'La imagen debe ser menor a 2MB',
                ],
            ]);

        return $validator;
    }
}
