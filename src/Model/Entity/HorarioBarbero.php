<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HorarioBarbero Entity
 *
 * @property int $id
 * @property int $barbero_id
 * @property \Cake\I18n\FrozenDate $fecha
 * @property \Cake\I18n\Time $hora_inicio
 * @property \Cake\I18n\Time $hora_fin
 * @property bool $disponible
 * @property string $turno
 *
 * @property \App\Model\Entity\Barbero $barbero
 */
class HorarioBarbero extends Entity
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
        'fecha' => true,
        'hora_inicio' => true,
        'hora_fin' => true,
        'disponible' => true,
        'turno' => true,
        'barbero' => true,
    ];
}
