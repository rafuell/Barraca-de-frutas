<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SaleItemsFixture
 */
class SaleItemsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'sale_id' => 1,
                'fruit_id' => 1,
                'quantity' => 1,
                'unit_price' => 1.5,
                'discount_percent' => 1,
                'created' => '2025-04-21 20:14:37',
            ],
        ];
        parent::init();
    }
}
