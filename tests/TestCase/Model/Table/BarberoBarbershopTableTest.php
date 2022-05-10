<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BarberoBarbershopTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BarberoBarbershopTable Test Case
 */
class BarberoBarbershopTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BarberoBarbershopTable
     */
    protected $BarberoBarbershop;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BarberoBarbershop',
        'app.Barbero',
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
        $config = $this->getTableLocator()->exists('BarberoBarbershop') ? [] : ['className' => BarberoBarbershopTable::class];
        $this->BarberoBarbershop = $this->getTableLocator()->get('BarberoBarbershop', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BarberoBarbershop);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BarberoBarbershopTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BarberoBarbershopTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
