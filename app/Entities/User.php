<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int    $id
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $user_type
 * @property bool   $is_banned
 */
class User extends Entity
{
    public const TYPE_ADMIN = 'admin';
    public const TYPE_USER  = 'user';

    protected $datamap = [];
    protected $casts   = [
        'id'        => 'int',
        'is_banned' => 'int-bool',
    ];

    /**
     * The password arrives here in plain text and is hashed by UserModel, in a
     * beforeInsert/beforeUpdate callback - that is, after validation has had the
     * chance to compare it against the confirmation field.
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->attributes['password'] ?? '');
    }

    public function isAdmin(): bool
    {
        return $this->attributes['user_type'] === self::TYPE_ADMIN;
    }

    public function getFullName(): string
    {
        return trim($this->attributes['first_name'] . ' ' . $this->attributes['last_name']);
    }
}
