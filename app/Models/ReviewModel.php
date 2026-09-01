<?php

namespace App\Models;

use App\Entities\Review;
use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table         = 'reviews';
    protected $primaryKey    = 'id';
    protected $returnType    = Review::class;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $allowedFields = ['product_id', 'user_id', 'body'];

    protected $validationRules = [
        'product_id' => 'required|is_natural_no_zero',
        'user_id'    => 'required|is_natural_no_zero',
        'body'       => 'trim|required|min_length[5]|max_length[500]',
    ];

    protected $validationMessages = [
        'body' => ['required' => 'You cannot post an empty review.'],
    ];

    /** Reviews of a product, newest first, with the author's name joined in. */
    public function forProduct(int $productId): array
    {
        return $this->select('reviews.*, users.username, users.first_name, users.last_name')
            ->join('users', 'users.id = reviews.user_id')
            ->where('reviews.product_id', $productId)
            ->orderBy('reviews.created_at', 'DESC')
            ->findAll();
    }
}
