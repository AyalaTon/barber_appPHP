<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Barbershop Model
 *
 * @property \App\Model\Table\PublicacionTable&\Cake\ORM\Association\HasMany $Publicacion
 * @property \App\Model\Table\BarberoTable&\Cake\ORM\Association\BelongsToMany $Barbero
 *
 * @method \App\Model\Entity\Barbershop newEmptyEntity()
 * @method \App\Model\Entity\Barbershop newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Barbershop[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Barbershop get($primaryKey, $options = [])
 * @method \App\Model\Entity\Barbershop findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Barbershop patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Barbershop[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Barbershop|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Barbershop saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Barbershop[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Barbershop[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Barbershop[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Barbershop[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BarbershopTable extends Table
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

        $this->setTable('barbershop');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Publicacion', [
            'foreignKey' => 'barbershop_id',
        ]);
        $this->belongsToMany('Barbero', [
            'foreignKey' => 'barbershop_id',
            'targetForeignKey' => 'barbero_id',
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
            ->scalar('nombre')
            ->maxLength('nombre', 100)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');

        $validator
            ->scalar('direccion')
            ->maxLength('direccion', 500)
            ->requirePresence('direccion', 'create')
            ->notEmptyString('direccion');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 9)
            ->requirePresence('tel', 'create')
            ->notEmptyString('tel');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('website')
            ->maxLength('website', 150)
            ->allowEmptyString('website');

        $validator
            ->date('habilitado')
            ->requirePresence('habilitado', 'create')
            ->notEmptyDate('habilitado');

        $validator
            ->scalar('latitud')
            ->maxLength('latitud', 255)
            ->notEmptyString('latitud');

        $validator
            ->scalar('longitud')
            ->maxLength('longitud', 255)
            ->notEmptyString('longitud');

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
