<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $total
 * @property string|null $shipping_address
 * @property string|null $payment_type
 * @property int $lib_status_code_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $payment_token
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\LibStatusCode $lib_status_code
 * @property \App\Model\Entity\OrderDetail[] $order_details
 */
class Order extends Entity
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
        'user_id' => true,
        'total' => true,
        'shipping_address' => true,
        'payment_type' => true,
        'lib_status_code_id' => true,
        'created' => true,
        'modified' => true,
        'payment_token' => true,
        'user' => true,
        'lib_status_code' => true,
        'order_details' => true
    ];
}
