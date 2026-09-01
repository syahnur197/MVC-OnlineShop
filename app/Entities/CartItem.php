<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * One line of a cart.
 *
 * @property int    $id
 * @property int    $cart_id
 * @property int    $product_id
 * @property int    $quantity
 * @property string $name   Joined in by CartItemModel::forCart().
 * @property float  $price  Joined in by CartItemModel::forCart().
 */
class CartItem extends Entity
{
    protected $casts = [
        'id'         => 'int',
        'cart_id'    => 'int',
        'product_id' => 'int',
        'quantity'   => 'int',
        'price'      => '?float',
    ];

    /** Only meaningful on rows that were loaded with the product joined in. */
    public function getSubtotal(): float
    {
        return (float) ($this->attributes['price'] ?? 0) * (int) $this->attributes['quantity'];
    }

    public function getImagePath(): string
    {
        return $this->attributes['image_path'] ?? 'style/assets/images/no_image.png';
    }
}
