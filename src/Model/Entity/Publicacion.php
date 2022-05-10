<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Publicacion Entity
 *
 * @property int $id
 * @property int $barbershop_id
 * @property string $contenido
 * @property string|null $imagen
 *
 * @property \App\Model\Entity\Barbershop $barbershop
 */
class Publicacion extends Entity
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
        'barbershop_id' => true,
        'contenido' => true,
        'imagen' => true,
        'barbershop' => true,
    ];
}
