<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ContactMessageModel;
use App\Models\ProductModel;
use App\Models\ReviewModel;

class Shop extends BaseController
{
    private const PER_PAGE = 6;

    public function index(): string
    {
        $products = model(ProductModel::class);

        return $this->page('shop/home', 'home', ' - Home', [
            'categories' => model(CategoryModel::class)->tree(),
            'products'   => $products->active()->paginate(self::PER_PAGE),
            'pager'      => $products->pager,
        ]);
    }

    public function product(int $productId): string
    {
        $product = model(ProductModel::class)->findWithImage($productId);

        if ($product === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->page('shop/product_page', 'home', ' - ' . $product->name, [
            'product' => $product,
            'reviews' => model(ReviewModel::class)->forProduct($productId),
        ]);
    }

    public function about(): string
    {
        return $this->page('shop/about_page', 'about', ' - All About Us');
    }

    public function contact(): string
    {
        return $this->page('shop/contact', 'contact', ' - Contact Us');
    }

    public function submitContact()
    {
        $messages = model(ContactMessageModel::class);

        if (! $messages->insert($this->request->getPost(['name', 'email', 'body']))) {
            return redirect()->back()->withInput()
                ->with('error', $this->errorList($messages->errors()));
        }

        return redirect()->to(site_url('shop/contact'))
            ->with('success', 'Thank you, your message has been sent.');
    }

    /** Every shop page is the same header/body/footer sandwich. */
    private function page(string $view, string $navItem, string $title, array $data = []): string
    {
        return view('layout/shop/header', ['title' => $title, 'navItem' => $navItem])
            . view($view, $data)
            . view('layout/shop/footer');
    }
}
