<?php

namespace App\Models;

use App\Entities\CartItem;
use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table         = 'cart_items';
    protected $primaryKey    = 'id';
    protected $returnType    = CartItem::class;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $allowedFields = ['cart_id', 'product_id', 'quantity'];

    protected $validationRules = [
        'cart_id'    => 'required|is_natural_no_zero',
        'product_id' => 'required|is_natural_no_zero',
        'quantity'   => 'required|is_natural_no_zero|less_than_equal_to[999]',
    ];

    protected $validationMessages = [
        'quantity' => ['is_natural_no_zero' => 'The quantity must be a whole number of at least 1.'],
    ];

    /** The lines of a cart, with product details and image joined in. */
    public function forCart(int $cartId): array
    {
        return $this->select('cart_items.*, products.name, products.price, products.short_description')
            ->select('product_images.path AS image_path')
            ->join('products', 'products.id = cart_items.product_id')
            ->join('product_images', 'product_images.product_id = products.id', 'left')
            ->where('cart_items.cart_id', $cartId)
            ->orderBy('cart_items.id', 'ASC')
            ->findAll();
    }

    public function totalFor(int $cartId): float
    {
        $row = $this->select('SUM(products.price * cart_items.quantity) AS total', false)
            ->join('products', 'products.id = cart_items.product_id')
            ->where('cart_items.cart_id', $cartId)
            ->first();

        return (float) ($row->total ?? 0);
    }

    public function countFor(int $cartId): int
    {
        return $this->where('cart_id', $cartId)->countAllResults();
    }

    /** Add a product, bumping the quantity when it is already in the cart. */
    public function add(int $cartId, int $productId, int $quantity): bool
    {
        $incoming = ['cart_id' => $cartId, 'product_id' => $productId, 'quantity' => $quantity];

        // Validate the amount being added rather than only the resulting total:
        // bumping an existing line by 0 would otherwise pass, because the sum is
        // still a valid quantity.
        if (! $this->validate($incoming)) {
            return false;
        }

        $existing = $this->where(['cart_id' => $cartId, 'product_id' => $productId])->first();

        if ($existing !== null) {
            return $this->update($existing->id, ['quantity' => $existing->quantity + $quantity]);
        }

        return (bool) $this->insert($incoming);
    }

    /**
     * Delete a line, but only when it belongs to an open cart of this user. Stops one
     * customer from deleting another's items by guessing an id.
     */
    public function removeOwned(int $cartItemId, int $userId): bool
    {
        $owned = $this->db->table('cart_items')
            ->join('carts', 'carts.id = cart_items.cart_id')
            ->where('cart_items.id', $cartItemId)
            ->where('carts.user_id', $userId)
            ->where('carts.ordered_at', null)
            ->countAllResults() > 0;

        return $owned && $this->delete($cartItemId);
    }
}
