<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ListaNegraTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ListaNegraTable Test Case
 */
class ListaNegraTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ListaNegraTable
     */
    protected $ListaNegra;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ListaNegra',
        'app.Barbero',
        'app.Cliente',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ListaNegra') ? [] : ['className' => ListaNegraTable::class];
        $this->ListaNegra = $this->getTableLocator()->get('ListaNegra', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ListaNegra);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ListaNegraTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ListaNegraTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
