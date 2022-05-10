<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CalificacionCorte Entity
 *
 * @property int $id
 * @property int $cliente_id
 * @property int $corte_id
 * @property int $calificacion
 * @property string|null $descripcion
 * @property string|null $foto
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Corte $corte
 */
class CalificacionCorte extends Entity
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
        'calificacion' => true,
        'descripcion' => true,
        'foto' => true,
        'cliente' => true,
        'corte' => true,
    ];
}
