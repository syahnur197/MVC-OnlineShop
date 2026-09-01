<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int         $id
 * @property int         $category_id
 * @property int         $seller_id
 * @property string      $name
 * @property float       $price
 * @property string      $short_description
 * @property string      $description
 * @property bool        $is_active
 * @property string|null $image_path     Joined in by ProductModel when an image exists.
 * @property string|null $category_name  Joined in by ProductModel::withCategory().
 */
class Product extends Entity
{
    protected $casts = [
        'id'          => 'int',
        'category_id' => 'int',
        'seller_id'   => 'int',
        'price'       => 'float',
        'is_active'   => 'int-bool',
    ];

    /** Falls back to the placeholder so views never have to check. */
    public function getImagePath(): string
    {
        return $this->attributes['image_path'] ?? 'style/assets/images/no_image.png';
    }
}
