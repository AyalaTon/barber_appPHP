<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BarberoBarbershopFixture
 */
class BarberoBarbershopFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'barbero_barbershop';
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
                'barbershop_id' => 1,
            ],
        ];
        parent::init();
    }
}
