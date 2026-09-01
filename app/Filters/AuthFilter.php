<?php

namespace App\Filters;

use App\Entities\User;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Route level access control. Registered as the "auth" alias, so routes read:
 *
 *     $routes->get('admin', 'Admin::index', ['filter' => 'auth:admin']);
 *     $routes->get('user/dashboard', 'User::dashboard', ['filter' => 'auth:user']);
 *
 * Without an argument it only requires somebody to be logged in.
 */
class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = service('auth');

        if (! $auth->check()) {
            return $this->refuse($request, 'Please log in first.', 'account');
        }

        $required = $arguments[0] ?? null;

        if ($required === User::TYPE_ADMIN && ! $auth->isAdmin()) {
            return $this->refuse($request, 'That area is for administrators only.', 'shop');
        }

        if ($required === User::TYPE_USER && ! $auth->isCustomer()) {
            return $this->refuse($request, 'That area is for customer accounts only.', 'shop');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }

    /** JSON for AJAX callers, a redirect with a flash message for everyone else. */
    private function refuse(RequestInterface $request, string $message, string $route): ResponseInterface
    {
        if ($request->isAJAX()) {
            return service('response')
                ->setStatusCode(ResponseInterface::HTTP_FORBIDDEN)
                ->setJSON(['success' => false, 'title' => 'Not allowed', 'message' => $message]);
        }

        return redirect()->to(site_url($route))->with('error', $message);
    }
}
