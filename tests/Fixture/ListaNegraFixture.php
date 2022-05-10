<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ListaNegraFixture
 */
class ListaNegraFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'lista_negra';
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
                'cliente_id' => 1,
                'descripcion' => 'Lorem ipsum dolor sit amet',
                'estado' => 1,
            ],
        ];
        parent::init();
    }
}
