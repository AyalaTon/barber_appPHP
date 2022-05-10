<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BarberoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BarberoTable Test Case
 */
class BarberoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BarberoTable
     */
    protected $Barbero;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Barbero',
        'app.CalificacionCliente',
        'app.Corte',
        'app.HorarioBarbero',
        'app.ListaNegra',
        'app.Barbershop',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Barbero') ? [] : ['className' => BarberoTable::class];
        $this->Barbero = $this->getTableLocator()->get('Barbero', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Barbero);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BarberoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
