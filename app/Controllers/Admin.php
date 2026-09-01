<?php

namespace App\Controllers;

use App\Models\AddressModel;
use App\Models\CartItemModel;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\ContactMessageModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * The whole admin dashboard. Behind the auth:admin filter, so every method here can
 * assume an administrator is logged in - there are no per-method checks any more.
 */
class Admin extends BaseController
{
    /** Where uploaded product pictures land, relative to public/. */
    private const UPLOAD_DIR = 'uploads';

    private const IMAGE_RULES = [
        'image' => [
            'rules'  => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]|max_size[image,2048]',
            'errors' => [
                'uploaded' => 'Please choose a picture for this product.',
                'is_image' => 'That file is not an image.',
                'max_size' => 'The picture must be 2 MB or smaller.',
            ],
        ],
    ];

    // -----------------------------------------------------------------------
    // Dashboard and messages
    // -----------------------------------------------------------------------

    public function index(): string
    {
        $messages = model(ContactMessageModel::class);

        return $this->page('admin/dashboard', null, 'Admin Dashboard', [
            'messages'    => $messages->latest(),
            'unreadCount' => $messages->unreadCount(),
        ]);
    }

    public function readMessage(int $messageId): string
    {
        $messages = model(ContactMessageModel::class);
        $message  = $messages->find($messageId);

        if ($message === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $messages->markRead($messageId);

        return $this->page('admin/read_message', null, 'Message', ['message' => $message]);
    }

    // -----------------------------------------------------------------------
    // Users
    // -----------------------------------------------------------------------

    public function users(): string
    {
        return $this->page('admin/userlist', 'users.manage', 'View Users', [
            'users' => model(UserModel::class)->customers(),
        ]);
    }

    public function banUser(int $userId)
    {
        return $this->setBanned($userId, true);
    }

    public function unbanUser(int $userId)
    {
        return $this->setBanned($userId, false);
    }

    // -----------------------------------------------------------------------
    // Products
    // -----------------------------------------------------------------------

    public function products(): string
    {
        return $this->page('admin/view_product', 'products.manage', 'View Products', [
            'products' => model(ProductModel::class)->withCategory(),
        ]);
    }

    public function newProduct(): string
    {
        return $this->page('admin/add_product', 'products.add', 'Add Product', [
            'categories' => model(CategoryModel::class)->tree(),
        ]);
    }

    public function createProduct()
    {
        $products = model(ProductModel::class);

        if (! $this->validate(self::IMAGE_RULES)) {
            return redirect()->back()->withInput()
                ->with('error', $this->errorList($this->validator->getErrors()));
        }

        $productId = $products->insert($this->productFromRequest());

        if ($productId === false) {
            return redirect()->back()->withInput()
                ->with('error', $this->errorList($products->errors()));
        }

        model(ProductImageModel::class)->insert([
            'product_id' => $productId,
            'path'       => $this->storeUpload(),
        ]);

        return redirect()->to(site_url('admin/view_product'))
            ->with('success', 'The product has been added.');
    }

    public function editProduct(int $productId): string
    {
        $product = model(ProductModel::class)->findWithImage($productId);

        if ($product === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $this->page('admin/edit_product', 'products.manage', 'Edit Product', [
            'product'    => $product,
            'categories' => model(CategoryModel::class)->tree(),
        ]);
    }

    public function updateProduct(int $productId)
    {
        $products = model(ProductModel::class);

        if ($products->find($productId) === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (! $products->update($productId, $this->productFromRequest())) {
            return redirect()->back()->withInput()
                ->with('error', $this->errorList($products->errors()));
        }

        // The picture is optional on edit: only validate one if the admin picked one.
        if ($this->request->getFile('image')?->isValid()) {
            if (! $this->validate(self::IMAGE_RULES)) {
                return redirect()->back()->withInput()
                    ->with('error', $this->errorList($this->validator->getErrors()));
            }

            $replaced = model(ProductImageModel::class)->replaceFor($productId, $this->storeUpload());

            if ($replaced !== null) {
                @unlink(FCPATH . $replaced);
            }
        }

        return redirect()->to(site_url('admin/view_product'))
            ->with('success', 'The product has been updated.');
    }

    public function changeProductStatus(int $productId)
    {
        $active = (bool) $this->request->getPost('is_active');

        model(ProductModel::class)->setActive($productId, $active);

        return redirect()->to(site_url('admin/view_product'))->with(
            'success',
            $active ? 'The product is back on sale.' : 'The product has been withdrawn from sale.',
        );
    }

    // -----------------------------------------------------------------------
    // Categories
    // -----------------------------------------------------------------------

    public function categories(): string
    {
        return $this->page('admin/view_category', 'categories.manage', 'View Categories', [
            'categories' => model(CategoryModel::class)->withParentAndProductCount(),
        ]);
    }

    public function newCategory(): string
    {
        return $this->page('admin/add_category', 'categories.add', 'Add Category', [
            'parents' => model(CategoryModel::class)->topLevel(),
        ]);
    }

    public function createCategory()
    {
        $categories = model(CategoryModel::class);

        if (! $categories->insert($this->categoryFromRequest())) {
            return redirect()->back()->withInput()
                ->with('error', $this->errorList($categories->errors()));
        }

        return redirect()->to(site_url('admin/view_category'))
            ->with('success', 'The category has been added.');
    }

    public function editCategory(int $categoryId): string
    {
        $categories = model(CategoryModel::class);
        $category   = $categories->find($categoryId);

        if ($category === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $this->page('admin/manage_category', 'categories.manage', 'Manage Category', [
            'category' => $category,
            'parents'  => $categories->topLevel(),
            'products' => model(ProductModel::class)->allInCategory($categoryId),
        ]);
    }

    public function updateCategory(int $categoryId)
    {
        $categories = model(CategoryModel::class);

        if ($categories->find($categoryId) === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $updated = $categories->setValidationRules($categories->rulesForUpdate($categoryId))
            ->update($categoryId, $this->categoryFromRequest());

        if (! $updated) {
            return redirect()->back()->withInput()
                ->with('error', $this->errorList($categories->errors()));
        }

        return redirect()->to(site_url('admin/view_category'))
            ->with('success', 'The category has been updated.');
    }

    // -----------------------------------------------------------------------
    // Carts and orders
    // -----------------------------------------------------------------------

    public function carts(): string
    {
        return $this->page('admin/manage_cart', 'orders.carts', 'Open Carts', [
            'carts' => $this->withTotals(model(CartModel::class)->openCartsWithUser()),
        ]);
    }

    public function orders(): string
    {
        return $this->page('admin/manage_order', 'orders.manage', 'Orders', [
            'orders' => $this->withTotals(model(CartModel::class)->ordersWithUser()),
        ]);
    }

    public function viewCart(int $cartId): string
    {
        return $this->page('admin/view_cart', 'orders.carts', 'View Cart', $this->cartData($cartId));
    }

    public function viewOrder(int $cartId): string
    {
        $data            = $this->cartData($cartId);
        $data['address'] = model(AddressModel::class)->forUser($data['cart']->user_id);

        return $this->page('admin/view_order', 'orders.manage', 'View Order', $data);
    }

    // -----------------------------------------------------------------------
    // Helpers
    // -----------------------------------------------------------------------

    private function setBanned(int $userId, bool $banned): ResponseInterface
    {
        $done = model(UserModel::class)->setBanned($userId, $banned);

        return redirect()->to(site_url('admin/view_users'))->with(
            $done ? 'success' : 'error',
            $done
                ? ($banned ? 'The account has been banned.' : 'The ban has been lifted.')
                : 'That account could not be updated.',
        );
    }

    private function productFromRequest(): array
    {
        return $this->request->getPost([
            'name',
            'price',
            'short_description',
            'description',
            'category_id',
        ]) + ['seller_id' => $this->auth->id()];
    }

    private function categoryFromRequest(): array
    {
        return [
            'name'      => $this->request->getPost('name'),
            'parent_id' => (int) $this->request->getPost('parent_id'),
        ];
    }

    /** Move the uploaded picture into public/uploads and return its public path. */
    private function storeUpload(): string
    {
        $file = $this->request->getFile('image');
        $name = $file->getRandomName();

        $file->move(FCPATH . self::UPLOAD_DIR, $name);

        return self::UPLOAD_DIR . '/' . $name;
    }

    /** @param list<object> $carts */
    private function withTotals(array $carts): array
    {
        $items = model(CartItemModel::class);

        foreach ($carts as $cart) {
            $cart->total = $items->totalFor($cart->id);
        }

        return $carts;
    }

    private function cartData(int $cartId): array
    {
        $cart = model(CartModel::class)->findWithUser($cartId);

        if ($cart === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $items = model(CartItemModel::class);

        return [
            'cart'  => $cart,
            'items' => $items->forCart($cartId),
            'total' => $items->totalFor($cartId),
        ];
    }

    /** Header, sidebar, body, footer - the shape every dashboard page has. */
    private function page(string $view, ?string $activeNav, string $title, array $data = []): string
    {
        return view('layout/dashboard/header', ['title' => $title])
            . view('layout/dashboard/sidebar', ['activeNav' => $activeNav])
            . view($view, $data)
            . view('layout/dashboard/footer');
    }
}
