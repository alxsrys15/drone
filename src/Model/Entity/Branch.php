<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Branch Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $street_address
 * @property string|null $barangay
 * @property string|null $city
 * @property string|null $province
 * @property string|null $contact_no
 * @property string|null $contact_person
 *
 * @property \App\Model\Entity\Order[] $orders
 */
class Branch extends Entity
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
        'name' => true,
        'street_address' => true,
        'barangay' => true,
        'city' => true,
        'province' => true,
        'contact_no' => true,
        'contact_person' => true,
        'orders' => true
    ];
}
