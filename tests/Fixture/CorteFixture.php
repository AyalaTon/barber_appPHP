<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CorteFixture
 */
class CorteFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'corte';
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
                'barbero_id' => 1,
                'nombre' => 'Lorem ipsum dolor sit amet',
                'descripcion' => 'Lorem ipsum dolor sit amet',
                'imagen' => 'Lorem ipsum dolor sit amet',
                'precio' => 1,
                'tiempo_estimado' => '23:14:44',
                'tipo' => 1,
            ],
        ];
        parent::init();
    }
}
