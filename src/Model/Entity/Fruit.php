<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fruit Entity
 *
 * @property int $id
 * @property string $name
 * @property string $classification
 * @property bool|null $is_fresh
 * @property int $quantity
 * @property string $price
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\SaleItem[] $sale_items
 */
class Fruit extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'classification' => true,
        'is_fresh' => true,
        'quantity' => true,
        'price' => true,
        'created' => true,
        'modified' => true,
        'sale_items' => true,
    ];
}
