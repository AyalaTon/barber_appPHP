<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TipoCorteFixture
 */
class TipoCorteFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'tipo_corte';
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
                'nombre' => 'Lorem ipsum dolor sit amet',
                'descripcion' => 'Lorem ipsum dolor sit amet',
                'imagen' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
