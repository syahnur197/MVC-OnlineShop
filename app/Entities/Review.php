<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int    $id
 * @property int    $product_id
 * @property int    $user_id
 * @property string $body
 * @property string $username  Joined in by ReviewModel::forProduct().
 */
class Review extends Entity
{
    protected $casts = [
        'id'         => 'int',
        'product_id' => 'int',
        'user_id'    => 'int',
    ];
}
