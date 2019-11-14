<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductVariant Entity
 *
 * @property int $product_id
 * @property int $size_id
 * @property int|null $sku
 * @property int $id
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Size $size
 */
class ProductVariant extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'product_id' => true,
        'size_id' => true,
        'sku' => true,
        'product' => true,
        'size' => true
    ];
}
