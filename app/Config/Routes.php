<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

/*
 * Auto routing is off, so every URL the CodeIgniter 3 application answered is listed
 * here. The paths are kept the same as before, so old links and bookmarks still work.
 */

// ---------------------------------------------------------------------------
// Shop front - open to everybody
// ---------------------------------------------------------------------------
$routes->get('/', 'Shop::index');
$routes->get('shop', 'Shop::index');
$routes->get('shop/product/(:num)', 'Shop::product/$1');
$routes->get('shop/about', 'Shop::about');
$routes->get('shop/contact', 'Shop::contact');
$routes->post('shop/contact', 'Shop::submitContact');

// Read only JSON used by the search box and the category filter on the home page.
$routes->get('products/search', 'ProductApi::search');
$routes->get('products/category/(:num)', 'ProductApi::byCategory/$1');

// ---------------------------------------------------------------------------
// Accounts
// ---------------------------------------------------------------------------
$routes->get('account', 'Account::login');
$routes->post('account/login', 'Account::attemptLogin');
$routes->get('account/register', 'Account::register');
$routes->post('account/register', 'Account::createAccount');
$routes->get('account/logout', 'Account::logout');

// ---------------------------------------------------------------------------
// Customer area
// ---------------------------------------------------------------------------
$routes->group('user', ['filter' => 'auth:user'], static function (RouteCollection $routes): void {
    $routes->get('/', 'User::dashboard');
    $routes->get('dashboard', 'User::dashboard');

    $routes->get('change_details', 'User::changeDetails');
    $routes->post('change_details', 'User::updateDetails');
    $routes->get('change_password', 'User::changePassword');
    $routes->post('change_password', 'User::updatePassword');

    $routes->get('your_cart', 'Cart::show');
    $routes->post('cart/add', 'Cart::add');
    $routes->post('cart/remove', 'Cart::remove');
    $routes->get('checkout', 'Cart::checkout');
    $routes->post('checkout', 'Cart::placeOrder');

    $routes->get('your_order', 'User::orders');
    $routes->get('view_order/(:num)', 'User::viewOrder/$1');

    $routes->post('review', 'Review::add');
});

// ---------------------------------------------------------------------------
// Admin dashboard
// ---------------------------------------------------------------------------
$routes->group('admin', ['filter' => 'auth:admin'], static function (RouteCollection $routes): void {
    $routes->get('/', 'Admin::index');

    $routes->get('read_message/(:num)', 'Admin::readMessage/$1');

    $routes->get('view_users', 'Admin::users');
    $routes->post('users/(:num)/ban', 'Admin::banUser/$1');
    $routes->post('users/(:num)/unban', 'Admin::unbanUser/$1');

    $routes->get('view_product', 'Admin::products');
    $routes->get('add_product', 'Admin::newProduct');
    $routes->post('add_product', 'Admin::createProduct');
    $routes->get('edit_product/(:num)', 'Admin::editProduct/$1');
    $routes->post('edit_product/(:num)', 'Admin::updateProduct/$1');
    $routes->post('products/(:num)/status', 'Admin::changeProductStatus/$1');

    $routes->get('view_category', 'Admin::categories');
    $routes->get('add_category', 'Admin::newCategory');
    $routes->post('add_category', 'Admin::createCategory');
    $routes->get('manage_category/(:num)', 'Admin::editCategory/$1');
    $routes->post('manage_category/(:num)', 'Admin::updateCategory/$1');

    $routes->get('manage_cart', 'Admin::carts');
    $routes->get('view_cart/(:num)', 'Admin::viewCart/$1');
    $routes->get('manage_order', 'Admin::orders');
    $routes->get('view_order/(:num)', 'Admin::viewOrder/$1');
});
