<?php

namespace App\Controllers;

use App\Models\AddressModel;
use App\Models\CartItemModel;
use App\Models\CartModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * The customer's basket and checkout. Behind the auth:user filter, so a logged in
 * customer can be assumed.
 */
class Cart extends BaseController
{
    public function show(): string
    {
        $carts = model(CartModel::class);
        $items = model(CartItemModel::class);
        $cart  = $carts->openCartFor($this->auth->id());

        return $this->page('user/manage_cart', 'cart.view', 'Your Cart', [
            'items' => $cart === null ? [] : $items->forCart($cart->id),
            'total' => $cart === null ? 0.0 : $items->totalFor($cart->id),
        ]);
    }

    /** Called over AJAX from the product cards, so it answers in JSON. */
    public function add(): ResponseInterface
    {
        $items  = model(CartItemModel::class);
        $cartId = model(CartModel::class)->openCartIdFor($this->auth->id());

        $added = $items->add(
            $cartId,
            (int) $this->request->getPost('product_id'),
            (int) $this->request->getPost('quantity'),
        );

        // CSRF tokens are regenerated per request, so hand the page the next one.
        return $this->response->setJSON([
            'success'  => $added,
            'title'    => $added ? 'Added' : 'Not added',
            'message'  => $added ? 'The product is in your cart.' : implode(' ', $items->errors()),
            'csrfHash' => csrf_hash(),
        ]);
    }

    public function remove()
    {
        $removed = model(CartItemModel::class)
            ->removeOwned((int) $this->request->getPost('cart_item_id'), $this->auth->id());

        return redirect()->to(site_url('user/your_cart'))->with(
            $removed ? 'success' : 'error',
            $removed ? 'The item was removed from your cart.' : 'That item is not in your cart.',
        );
    }

    public function checkout()
    {
        $carts = model(CartModel::class);
        $items = model(CartItemModel::class);
        $cart  = $carts->openCartFor($this->auth->id());

        if ($cart === null || $items->countFor($cart->id) === 0) {
            return redirect()->to(site_url('user/your_cart'))
                ->with('error', 'Your cart is empty, so there is nothing to check out.');
        }

        return $this->page('user/checkout', 'cart.view', 'Checkout', [
            'items'   => $items->forCart($cart->id),
            'total'   => $items->totalFor($cart->id),
            'user'    => $this->auth->user(),
            'address' => model(AddressModel::class)->forUser($this->auth->id()),
        ]);
    }

    public function placeOrder()
    {
        $carts  = model(CartModel::class);
        $items  = model(CartItemModel::class);
        $userId = $this->auth->id();
        $cart   = $carts->openCartFor($userId);

        if ($cart === null || $items->countFor($cart->id) === 0) {
            return redirect()->to(site_url('user/your_cart'))
                ->with('error', 'Your cart is empty, so there is nothing to check out.');
        }

        $addresses = model(AddressModel::class);
        $address   = $this->request->getPost(['street', 'town', 'postcode', 'country']);

        if (! $addresses->saveFor($userId, $address)) {
            return redirect()->back()->withInput()
                ->with('error', $this->errorList($addresses->errors()));
        }

        $carts->markOrdered($cart->id);

        return redirect()->to(site_url('user/your_order'))
            ->with('success', 'Thank you, your order has been placed.');
    }

    private function page(string $view, ?string $activeNav, string $title, array $data = []): string
    {
        return view('layout/dashboard/header', ['title' => $title])
            . view('layout/user/sidebar', ['activeNav' => $activeNav])
            . view($view, $data)
            . view('layout/dashboard/footer');
    }
}
