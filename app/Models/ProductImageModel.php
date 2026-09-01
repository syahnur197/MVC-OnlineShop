<?php

namespace App\Models;

use App\Entities\ProductImage;
use CodeIgniter\Model;

class ProductImageModel extends Model
{
    protected $table         = 'product_images';
    protected $primaryKey    = 'id';
    protected $returnType    = ProductImage::class;
    protected $useTimestamps = false;
    protected $allowedFields = ['product_id', 'path'];

    public function forProduct(int $productId): ?ProductImage
    {
        return $this->where('product_id', $productId)->first();
    }

    /**
     * Point a product at a newly uploaded file. Returns the path of the file that was
     * replaced, so the caller can delete it, or null when the product had no image.
     */
    public function replaceFor(int $productId, string $path): ?string
    {
        $existing = $this->forProduct($productId);

        if ($existing === null) {
            $this->insert(['product_id' => $productId, 'path' => $path]);

            return null;
        }

        $this->update($existing->id, ['path' => $path]);

        return $existing->path;
    }
}
