<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CalificacionCorteFixture
 */
class CalificacionCorteFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'calificacion_corte';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'cliente_id' => 1,
                'corte_id' => 1,
                'calificacion' => 1,
                'descripcion' => 'Lorem ipsum dolor sit amet',
                'foto' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
