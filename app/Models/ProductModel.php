<?php

namespace App\Models;

use App\Entities\Product;
use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table         = 'products';
    protected $primaryKey    = 'id';
    protected $returnType    = Product::class;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $allowedFields = [
        'category_id',
        'seller_id',
        'name',
        'price',
        'short_description',
        'description',
        'is_active',
    ];

    protected $validationRules = [
        'name'              => 'trim|required|min_length[10]|max_length[100]',
        'price'             => 'required|decimal|greater_than[0]',
        'short_description' => 'trim|required|min_length[10]|max_length[50]',
        'description'       => 'required|min_length[10]',
        'category_id'       => 'required|is_natural_no_zero',
    ];

    protected $validationMessages = [
        'name'        => ['min_length' => 'The product name must be at least 10 characters long.'],
        'price'       => ['decimal' => 'The price must be a decimal number.'],
        'category_id' => ['required' => 'Please pick a category for this product.'],
    ];

    /** Products the shop front may show, with their image joined in. */
    public function active(): static
    {
        return $this->withImage()->where('products.is_active', 1);
    }

    public function findWithImage(int $productId): ?Product
    {
        return $this->withImage()->where('products.id', $productId)->first();
    }

    public function inCategory(int $categoryId): array
    {
        return $this->active()->where('products.category_id', $categoryId)->findAll();
    }

    public function searchActive(string $term): array
    {
        return $this->active()->like('products.name', $term)->findAll();
    }

    /** Admin listings show withdrawn products too. */
    public function withCategory(): array
    {
        return $this->select('products.*, categories.name AS category_name')
            ->join('categories', 'categories.id = products.category_id')
            ->orderBy('products.id', 'ASC')
            ->findAll();
    }

    public function allInCategory(int $categoryId): array
    {
        return $this->where('category_id', $categoryId)->orderBy('name', 'ASC')->findAll();
    }

    public function setActive(int $productId, bool $active): bool
    {
        return $this->update($productId, ['is_active' => (int) $active]);
    }

    private function withImage(): static
    {
        return $this->select('products.*, product_images.path AS image_path')
            ->join('product_images', 'product_images.product_id = products.id', 'left');
    }
}
