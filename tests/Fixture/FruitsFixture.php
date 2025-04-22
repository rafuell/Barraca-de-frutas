<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FruitsFixture
 */
class FruitsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'classification' => 'Lorem ipsum dolor sit amet',
                'is_fresh' => 1,
                'quantity' => 1,
                'price' => 1.5,
                'created' => '2025-04-21 20:14:37',
                'modified' => '2025-04-21 20:14:37',
            ],
        ];
        parent::init();
    }
}
