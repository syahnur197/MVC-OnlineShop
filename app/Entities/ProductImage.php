<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int    $id
 * @property int    $product_id
 * @property string $path  Public path of the uploaded file, e.g. "uploads/shoe.jpg".
 */
class ProductImage extends Entity
{
    protected $casts = [
        'id'         => 'int',
        'product_id' => 'int',
    ];
}
