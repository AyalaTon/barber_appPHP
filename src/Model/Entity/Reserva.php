<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reserva Entity
 *
 * @property int $id
 * @property int $cliente_id
 * @property int $corte_id
 * @property \Cake\I18n\FrozenDate $fecha_corte
 * @property \Cake\I18n\Time $hora_comienzo_corte
 * @property \Cake\I18n\FrozenTime $fecha_reserva
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Corte $corte
 */
class Reserva extends Entity
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
        'cliente_id' => true,
        'corte_id' => true,
        'fecha_corte' => true,
        'hora_comienzo_corte' => true,
        'fecha_reserva' => true,
        'cliente' => true,
        'corte' => true,
    ];
}
