<?php

namespace App\Models;

use App\Entities\Address;
use CodeIgniter\Model;

/** A user has at most one shipping address. */
class AddressModel extends Model
{
    protected $table         = 'addresses';
    protected $primaryKey    = 'id';
    protected $returnType    = Address::class;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $allowedFields = ['user_id', 'street', 'town', 'postcode', 'country'];

    protected $validationRules = [
        'street'   => 'trim|required|max_length[100]',
        'town'     => 'trim|required|max_length[50]',
        'postcode' => 'trim|required|max_length[10]',
        'country'  => 'trim|required|max_length[50]',
    ];

    public function forUser(int $userId): ?Address
    {
        return $this->where('user_id', $userId)->first();
    }

    /** Insert or update, whichever this user needs. */
    public function saveFor(int $userId, array $address): bool
    {
        $existing = $this->forUser($userId);

        if ($existing !== null) {
            return $this->update($existing->id, $address);
        }

        return (bool) $this->insert($address + ['user_id' => $userId]);
    }
}
