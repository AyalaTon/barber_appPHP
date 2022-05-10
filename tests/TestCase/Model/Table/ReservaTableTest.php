<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReservaTable Test Case
 */
class ReservaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservaTable
     */
    protected $Reserva;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Reserva',
        'app.Cliente',
        'app.Corte',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Reserva') ? [] : ['className' => ReservaTable::class];
        $this->Reserva = $this->getTableLocator()->get('Reserva', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Reserva);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ReservaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ReservaTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
