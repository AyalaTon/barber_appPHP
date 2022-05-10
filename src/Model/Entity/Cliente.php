<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cliente Entity
 *
 * @property int $id
 * @property string $usuario
 * @property string $nombre
 * @property string $email
 * @property string $clave
 * @property string|null $imagen_perfil
 * @property string|null $tel
 *
 * @property \App\Model\Entity\CalificacionCliente[] $calificacion_cliente
 * @property \App\Model\Entity\CalificacionCorte[] $calificacion_corte
 * @property \App\Model\Entity\ListaNegra[] $lista_negra
 * @property \App\Model\Entity\Reserva[] $reserva
 */
class Cliente extends Entity
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
        'usuario' => true,
        'nombre' => true,
        'email' => true,
        'clave' => true,
        'imagen_perfil' => true,
        'tel' => true,
        'calificacion_cliente' => true,
        'calificacion_corte' => true,
        'lista_negra' => true,
        'reserva' => true,
    ];
}
