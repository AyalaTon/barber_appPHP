<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BarbershopTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BarbershopTable Test Case
 */
class BarbershopTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BarbershopTable
     */
    protected $Barbershop;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Barbershop',
        'app.Publicacion',
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
        $config = $this->getTableLocator()->exists('Barbershop') ? [] : ['className' => BarbershopTable::class];
        $this->Barbershop = $this->getTableLocator()->get('Barbershop', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Barbershop);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BarbershopTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
