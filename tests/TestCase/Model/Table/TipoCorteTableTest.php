<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoCorteTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoCorteTable Test Case
 */
class TipoCorteTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoCorteTable
     */
    protected $TipoCorte;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TipoCorte',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TipoCorte') ? [] : ['className' => TipoCorteTable::class];
        $this->TipoCorte = $this->getTableLocator()->get('TipoCorte', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TipoCorte);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TipoCorteTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
