<?php

namespace App\Controllers;

use App\Models\CartItemModel;
use App\Models\CartModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * The customer's own area. Every route here goes through the auth:user filter, so
 * these methods can assume a logged in customer.
 */
class User extends BaseController
{
    public function dashboard(): string
    {
        return $this->page('user/dashboard', null, 'Your Account', [
            'user' => $this->auth->user(),
        ]);
    }

    public function changeDetails(): string
    {
        return $this->page('user/change_details', 'profile.details', 'Change Details', [
            'user' => $this->auth->user(),
        ]);
    }

    public function updateDetails()
    {
        $users  = model(UserModel::class);
        $userId = $this->auth->id();

        $details = $this->request->getPost(['first_name', 'last_name', 'username', 'email']);

        // Rules that let this user keep their own username and e-mail address.
        if (! $users->setValidationRules($users->rulesForProfile($userId))->update($userId, $details)) {
            return redirect()->back()->withInput()
                ->with('error', $this->errorList($users->errors()));
        }

        // The navigation bar shows the username, so refresh the copy in the session.
        $this->auth->refresh();

        return redirect()->to(site_url('user/change_details'))
            ->with('success', 'Your account details have been updated.');
    }

    public function changePassword(): string
    {
        return $this->page('user/change_password', 'profile.password', 'Change Password');
    }

    public function updatePassword()
    {
        $users = model(UserModel::class);

        // Validate the plain password here: by the time it reaches the model it is hashed.
        if (! $this->validate($users->passwordRules())) {
            return redirect()->back()->with('error', $this->errorList($this->validator->getErrors()));
        }

        $changed = $users->changePassword(
            $this->auth->id(),
            (string) $this->request->getPost('current_password'),
            (string) $this->request->getPost('password'),
        );

        return $changed
            ? redirect()->to(site_url('user/change_password'))->with('success', 'Your password has been changed.')
            : redirect()->to(site_url('user/change_password'))->with('error', 'Your current password is not correct.');
    }

    public function orders(): string
    {
        $items  = model(CartItemModel::class);
        $orders = model(CartModel::class)->ordersWithUser($this->auth->id());

        foreach ($orders as $order) {
            $order->total = $items->totalFor($order->id);
        }

        return $this->page('user/manage_order', 'orders.list', 'Your Orders', ['orders' => $orders]);
    }

    public function viewOrder(int $cartId): string
    {
        // An order id from another customer must not open somebody else's order.
        if (! model(CartModel::class)->belongsTo($cartId, $this->auth->id())) {
            throw PageNotFoundException::forPageNotFound();
        }

        $items = model(CartItemModel::class);

        return $this->page('user/view_order', 'orders.list', 'Your Order', [
            'order' => model(CartModel::class)->find($cartId),
            'items' => $items->forCart($cartId),
            'total' => $items->totalFor($cartId),
        ]);
    }

    /** Header, sidebar, body, footer - the shape every customer page has. */
    private function page(string $view, ?string $activeNav, string $title, array $data = []): string
    {
        return view('layout/dashboard/header', ['title' => $title])
            . view('layout/user/sidebar', ['activeNav' => $activeNav])
            . view($view, $data)
            . view('layout/dashboard/footer');
    }
}
