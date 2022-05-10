<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorarioBarberoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorarioBarberoTable Test Case
 */
class HorarioBarberoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HorarioBarberoTable
     */
    protected $HorarioBarbero;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.HorarioBarbero',
        'app.Barbero',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('HorarioBarbero') ? [] : ['className' => HorarioBarberoTable::class];
        $this->HorarioBarbero = $this->getTableLocator()->get('HorarioBarbero', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->HorarioBarbero);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\HorarioBarberoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\HorarioBarberoTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
