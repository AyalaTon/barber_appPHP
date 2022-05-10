<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ListaNegra Entity
 *
 * @property int $id
 * @property int $barbero_id
 * @property int $cliente_id
 * @property string $descripcion
 * @property bool $estado
 *
 * @property \App\Model\Entity\Barbero $barbero
 * @property \App\Model\Entity\Cliente $cliente
 */
class ListaNegra extends Entity
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
        'cliente_id' => true,
        'descripcion' => true,
        'estado' => true,
        'barbero' => true,
        'cliente' => true,
    ];
}
