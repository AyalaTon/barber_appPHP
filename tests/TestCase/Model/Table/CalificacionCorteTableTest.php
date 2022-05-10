<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CalificacionCorteTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CalificacionCorteTable Test Case
 */
class CalificacionCorteTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CalificacionCorteTable
     */
    protected $CalificacionCorte;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CalificacionCorte',
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
        $config = $this->getTableLocator()->exists('CalificacionCorte') ? [] : ['className' => CalificacionCorteTable::class];
        $this->CalificacionCorte = $this->getTableLocator()->get('CalificacionCorte', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CalificacionCorte);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CalificacionCorteTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CalificacionCorteTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
