<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * A message left through the "contact us" form.
 *
 * @property int    $id
 * @property string $name
 * @property string $email
 * @property string $body
 * @property bool   $is_read
 */
class ContactMessage extends Entity
{
    protected $casts = [
        'id'      => 'int',
        'is_read' => 'int-bool',
    ];
}
