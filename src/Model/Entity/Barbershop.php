<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Barbershop Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property string $tel
 * @property string|null $email
 * @property string|null $website
 * @property \Cake\I18n\FrozenDate $habilitado
 * @property string|null $latitud
 * @property string|null $longitud
 * @property string|null $imagen_perfil
 *
 * @property \App\Model\Entity\Publicacion[] $publicacion
 * @property \App\Model\Entity\Barbero[] $barbero
 */
class Barbershop extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'nombre' => true,
        'direccion' => true,
        'tel' => true,
        'email' => true,
        'website' => true,
        'habilitado' => true,
        'latitud' => true,
        'longitud' => true,
        'imagen_perfil' => true,
        'publicacion' => true,
        'barbero' => true,
    ];
}
