<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PublicacionFixture
 */
class PublicacionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'publicacion';
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
                'barbershop_id' => 1,
                'contenido' => 'Lorem ipsum dolor sit amet',
                'imagen' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
