<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HorarioBarberoFixture
 */
class HorarioBarberoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'horario_barbero';
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
                'fecha' => '2022-05-10',
                'hora_inicio' => '23:15:33',
                'hora_fin' => '23:15:33',
                'disponible' => 1,
                'turno' => 'L',
            ],
        ];
        parent::init();
    }
}
