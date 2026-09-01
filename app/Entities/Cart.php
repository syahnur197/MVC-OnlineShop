<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

/**
 * A shopping cart. It becomes an order the moment ordered_at is set.
 *
 * @property int       $id
 * @property int       $user_id
 * @property Time|null $ordered_at
 * @property string    $username    Joined in by CartModel when it selects the owner.
 */
class Cart extends Entity
{
    protected $casts = [
        'id'      => 'int',
        'user_id' => 'int',
    ];

    protected $dates = ['ordered_at', 'created_at', 'updated_at'];

    public function isOpen(): bool
    {
        return ($this->attributes['ordered_at'] ?? null) === null;
    }
}
