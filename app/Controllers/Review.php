<?php

namespace App\Controllers;

use App\Models\ReviewModel;

class Review extends BaseController
{
    public function add()
    {
        $reviews   = model(ReviewModel::class);
        $productId = (int) $this->request->getPost('product_id');

        $saved = $reviews->insert([
            'product_id' => $productId,
            'user_id'    => $this->auth->id(),
            'body'       => $this->request->getPost('body'),
        ]);

        return redirect()->to(site_url('shop/product/' . $productId))->with(
            $saved ? 'success' : 'error',
            $saved ? 'Thank you for your review.' : $this->errorList($reviews->errors()),
        );
    }
}
