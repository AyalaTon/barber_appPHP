<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BarberoFixture
 */
class BarberoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'barbero';
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
                'usuario' => 'Lorem ipsum dolor sit amet',
                'nombre' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'clave' => 'Lorem ipsum dolor sit amet',
                'imagen_perfil' => 'Lorem ipsum dolor sit amet',
                'tel' => 'Lorem i',
                'token' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
