<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Corte Entity
 *
 * @property int $id
 * @property int $barbero_id
 * @property string $nombre
 * @property string $descripcion
 * @property string $imagen
 * @property int $precio
 * @property \Cake\I18n\Time $tiempo_estimado
 * @property int $tipo
 *
 * @property \App\Model\Entity\Barbero $barbero
 * @property \App\Model\Entity\CalificacionCorte[] $calificacion_corte
 * @property \App\Model\Entity\Reserva[] $reserva
 */
class Corte extends Entity
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
        'barbero_id' => true,
        'nombre' => true,
        'descripcion' => true,
        'imagen' => true,
        'precio' => true,
        'tiempo_estimado' => true,
        'tipo' => true,
        'barbero' => true,
        'calificacion_corte' => true,
        'reserva' => true,
    ];
}
