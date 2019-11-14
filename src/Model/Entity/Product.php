<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $img1
 * @property string|null $img2
 * @property string|null $img3
 * @property string $description
 * @property float $price
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\ProductVariant[] $product_variants
 */
class Product extends Entity
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
        'category_id' => true,
        'name' => true,
        'img1' => true,
        'img2' => true,
        'img3' => true,
        'description' => true,
        'price' => true,
        'created' => true,
        'modified' => true,
        'category' => true,
        'product_variants' => true
    ];
}
