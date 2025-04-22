<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FruitsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FruitsTable Test Case
 */
class FruitsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FruitsTable
     */
    protected $Fruits;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Fruits',
        'app.SaleItems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Fruits') ? [] : ['className' => FruitsTable::class];
        $this->Fruits = $this->getTableLocator()->get('Fruits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Fruits);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FruitsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
