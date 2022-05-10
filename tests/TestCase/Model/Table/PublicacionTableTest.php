<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PublicacionTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PublicacionTable Test Case
 */
class PublicacionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PublicacionTable
     */
    protected $Publicacion;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Publicacion',
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
        $config = $this->getTableLocator()->exists('Publicacion') ? [] : ['className' => PublicacionTable::class];
        $this->Publicacion = $this->getTableLocator()->get('Publicacion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Publicacion);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PublicacionTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PublicacionTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
