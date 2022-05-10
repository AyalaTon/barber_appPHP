<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReservaFixture
 */
class ReservaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'reserva';
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
                'fecha_corte' => '2022-05-10',
                'hora_comienzo_corte' => '23:18:21',
                'fecha_reserva' => '2022-05-10 23:18:21',
            ],
        ];
        parent::init();
    }
}
