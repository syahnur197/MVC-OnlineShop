<?php

class Product_model extends CI_Model {
    
    /**
        Get all products

        @return PHP Object of all product
    **/
    public function getAllProducts() {
        return $this->db->join(CATEGORY, "catt.category_id = pt.category_id")->get(PRODUCT);
    }

    /**
        Get six products for display on homepage

        @return PHP Object of six products 
    **/

    public function getSixProducts() {
        return $this->db->limit(6)->get(PRODUCT);
    }

    /**
        Get data of product

        @param int $product_id

        @return PHP Object of product data
    **/

    public function getProduct($product_id = "") {
        return $this->db
            ->join('product_images pi', 'pi.product_id = pt.product_id', 'left')
            ->get_where('product_table pt', array("pt.product_id" => $product_id));
    }

    /**
        Get data of product in a category

        @param int $category_id (DEFAULT = "")

        @return PHP Object of product data of the category
    **/

    public function getCategoryProduct($category_id = "") {
        return $this->db->join(CATEGORY, "catt.category_id = pt.category_id")->get_where(PRODUCT, array("pt.category_id" => $category_id));
    }

    /**
        Get data of active product in a category

        @param int $category_id (DEFAULT = "")

        @return PHP Object of product data of the category
    **/

    public function getActiveCategoryProduct($category_id = "") {
        return $this->db
            ->join('product_images pi', 'pi.product_id = pt.product_id')
            ->get_where(PRODUCT, array("category_id" => $category_id, "active_flag" => 0));
    }

    /**
        Get data of seller's product

        @param int $seller (DEFAULT = "")

        @return PHP Object of seller's product data
    **/

    public function getSellerProduct($seller_id = "") {
        return $this->db->get_where(PRODUCT, array("seller_id" => $seller_id));		
    }

    /**
        Add product and insert image

        @param arr, String $image_link

        @return void
    **/

    public function addProduct($array, $image_link) {
        $insert = $this->db->insert("product_table", $array);
        $product_id = $this->db->insert_id();
        $this->db->insert('product_images', array('product_id' => $product_id, "image_link" => $image_link));
        return $insert;
    }

    /**
        Update product data with product image

        @param int $product_id (DEFAULT = ""), arr $array, String $image_link

        @return void
    **/

    public function updateProductWithProductImage($product_id, $array, $image_link) {
        $update = $this->db->where("product_id", $product_id)->update(PRODUCT, $array);
        $productImageId = $this->getProductImageId($product_id);
        if (!$productImageId) {
            $this->db->insert('product_images', array('product_id' => $product_id, "image_link" => $image_link));
        } else {
            $image_path = $_SERVER['DOCUMENT_ROOT'].'/codeigniter/'.$this->getProductImageLink($product_id);
            unlink($image_path);
            $this->db->where(array('product_id' => $product_id))->update('product_images', array("image_link" => $image_link));
        }
        return $update;
    }

    /**
        Update product

        @param int $product_id (DEFAULT = ""), arr $array, String $image_link

        @return void
    **/
    
    public function updateProduct($product_id, $array) {
        return $this->db->where("product_id", $product_id)->update(PRODUCT, $array);
    }

    /**
        Get data of searched product

        @param String $search (DEFAULT = "")

        @return PHP Object of product data
    **/

    public function searchProduct($search = "") {
        return $this->db->like('product_name', "$search")->get(PRODUCT);
    }

    /**
        Get data of searched product

        @param String $search (DEFAULT = "")

        @return PHP Object of product data
    **/

    public function searchActiveProduct($search = "") {
        return $this->db
            ->join('product_images pi', 'pi.product_id = pt.product_id')
            ->like('product_name', "$search")->get_where(PRODUCT, array("active_flag" => 0));
    }

    /**
        Get data of active product

        @param int $product_id (DEFAULT = "")

        @return PHP Object of product data
    **/

    /* 	UNUSED
    public function getActiveProduct($userid) {
        return $this->db->join(CATEGORY, "catt.category_id = pt.category_id")->get_where(PRODUCT,array("seller_id" => $userid));
    } 
    */

    /**
        Change product staus

        @param int $product_id, int $active_flag

        @return void
    **/

    public function changeStatus($product_id, $active_flag) {
        return $this->db->where('product_id', $product_id)->update(PRODUCT, array('active_flag' => $active_flag));
    }

    /** 
        Get the product name

        @param int $product_id

        @return String product_name
    */
    
    public function getProductName ($product_id) {
        return $this->db->where('product_id', $product_id)->get('product_table')->row()->product_name;
    }
    
    /** 
        Get all active products

        @return PHP Object of all active products
    */
    
    public function getActiveProduct() {
        return $this->db
        ->join('product_images pi', 'pi.product_id = pt.product_id')
        ->get_where('product_table pt', array('pt.active_flag' => 0))->result();
    }
    
    /** 
        Get the image link of the product

        @param int $product_id

        @return String of image_link
    */
    
    public function getProductImageLink($product_id) {
        $image = $this->db->get_where('product_images', array('product_id' => $product_id))->row();
        if (count($image) != 0) {
            return $image->image_link;
        } else {
            return null;
        }
    }
    
    /** 
        Get the product image id

        @param int $product_id

        @return int product_image_id
    */
    
    public function getProductImageId($product_id) {
        $image = $this->db->get_where('product_images', array('product_id' => $product_id))->row();
        if (count($image) != 0) {
            return $image->product_images_id;
        } else {
            return false;
        }
    }
    
    /** 
        Get all of product review

        @param int $product_id

        @return PHP Object of product review
    */
    
    public function getProductReview($product_id) {
        return $this->db
        ->join('user_table ut', 'ut.user_id=rt.user_id')
        ->get_where('review_table rt', array('product_id' => $product_id))->result();
    }
    
    /** 
        Add review to a product

        @param arr $data

        @return boolean
    */
    
    public function addProductReview($data) {
        return $this->db->insert('review_table', $data);
    }
    
    /** 
        Get product count

        @return int
    */
    
    public function getProductCount() {
        return $this->db->count_all('product_table');
    }

    /** 
        Get specific amount of product

        @param int @limit int $start

        @return PHP Object
    */

     public function getLimitProducts($limit, $start) {
        $query = $this->db->limit($limit, $start)
            ->join('product_images pi', 'pi.product_id = pt.product_id')
            ->get_where('product_table pt', array('pt.active_flag' => 0));
        if($query->num_rows() > 0) {
             return $query->result();
        } else {
             return false;
        }
     }
}
