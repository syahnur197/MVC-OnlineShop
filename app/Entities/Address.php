<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * A user's shipping address.
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $street
 * @property string $town
 * @property string $postcode
 * @property string $country
 */
class Address extends Entity
{
    protected $casts = [
        'id'      => 'int',
        'user_id' => 'int',
    ];

    public function getSingleLine(): string
    {
        return implode(', ', array_filter([
            $this->attributes['street'] ?? null,
            $this->attributes['town'] ?? null,
            $this->attributes['postcode'] ?? null,
            $this->attributes['country'] ?? null,
        ]));
    }
}
