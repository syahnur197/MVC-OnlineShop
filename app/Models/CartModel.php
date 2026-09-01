<?php

namespace App\Models;

use App\Entities\Cart;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

/**
 * Carts and orders are the same table: a cart with ordered_at still NULL is an open
 * basket, a cart with ordered_at set is an order.
 */
class CartModel extends Model
{
    protected $table         = 'carts';
    protected $primaryKey    = 'id';
    protected $returnType    = Cart::class;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $allowedFields = ['user_id', 'ordered_at'];

    public function openCartFor(int $userId): ?Cart
    {
        return $this->where('user_id', $userId)->where('ordered_at', null)->first();
    }

    /** The user's open cart id, opening a cart if this is their first item. */
    public function openCartIdFor(int $userId): int
    {
        return $this->openCartFor($userId)?->id
            ?? (int) $this->insert(['user_id' => $userId]);
    }

    /** Turn the open cart into an order. */
    public function markOrdered(int $cartId): bool
    {
        return $this->update($cartId, ['ordered_at' => Time::now()->toDateTimeString()]);
    }

    public function belongsTo(int $cartId, int $userId): bool
    {
        return $this->where(['id' => $cartId, 'user_id' => $userId])->countAllResults() > 0;
    }

    /** Open baskets of every customer, for the admin dashboard. */
    public function openCartsWithUser(): array
    {
        return $this->withUser()->where('carts.ordered_at', null)
            ->orderBy('carts.id', 'DESC')
            ->findAll();
    }

    /** Placed orders, newest first, optionally narrowed to one customer. */
    public function ordersWithUser(?int $userId = null): array
    {
        $orders = $this->withUser()->where('carts.ordered_at IS NOT NULL')
            ->orderBy('carts.ordered_at', 'DESC');

        if ($userId !== null) {
            $orders->where('carts.user_id', $userId);
        }

        return $orders->findAll();
    }

    public function findWithUser(int $cartId): ?Cart
    {
        return $this->withUser()->where('carts.id', $cartId)->first();
    }

    private function withUser(): static
    {
        return $this->select('carts.*, users.username, users.first_name, users.last_name, users.email')
            ->join('users', 'users.id = carts.user_id');
    }
}
