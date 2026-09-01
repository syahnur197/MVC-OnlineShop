<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * The JSON the home page asks for while the visitor types in the search box or picks
 * a category. Read only, and it only ever exposes products that are on sale.
 */
class ProductApi extends BaseController
{
    public function search(): ResponseInterface
    {
        $term = trim((string) $this->request->getGet('q'));

        $products = $term === ''
            ? []
            : model(ProductModel::class)->searchActive($term);

        return $this->response->setJSON($this->toJson($products));
    }

    public function byCategory(int $categoryId): ResponseInterface
    {
        return $this->response->setJSON(
            $this->toJson(model(ProductModel::class)->inCategory($categoryId)),
        );
    }

    /** Only the fields the front end draws, and a ready made URL for each product. */
    private function toJson(array $products): array
    {
        return array_map(static fn ($product) => [
            'id'                => $product->id,
            'name'              => $product->name,
            'price'             => $product->price,
            'short_description' => $product->short_description,
            'url'               => site_url('shop/product/' . $product->id),
            'image'             => base_url($product->image_path),
        ], $products);
    }
}
