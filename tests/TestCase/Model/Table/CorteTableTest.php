<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CorteTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CorteTable Test Case
 */
class CorteTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CorteTable
     */
    protected $Corte;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Corte',
        'app.Barbero',
        'app.CalificacionCorte',
        'app.Reserva',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Corte') ? [] : ['className' => CorteTable::class];
        $this->Corte = $this->getTableLocator()->get('Corte', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Corte);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CorteTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CorteTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
