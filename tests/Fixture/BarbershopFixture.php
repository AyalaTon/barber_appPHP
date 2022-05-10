<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BarbershopFixture
 */
class BarbershopFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'barbershop';
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
                'direccion' => 'Lorem ipsum dolor sit amet',
                'tel' => 'Lorem i',
                'email' => 'Lorem ipsum dolor sit amet',
                'website' => 'Lorem ipsum dolor sit amet',
                'habilitado' => '2022-05-10',
            ],
        ];
        parent::init();
    }
}
