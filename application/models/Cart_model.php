<?php

class Cart_model extends CI_Model {

    /**
        Get all cart of the user

        @param int $user_id

        @return PHP Object of all user cart 
    **/

	public function getAllUserCart() {
        return $this->db->get_where(CART, array( 'user_id' => $_SESSION['userid'] ))->result();
    } 

    /**
        Get all carts in db

        @return PHP Object of all cart
    **/
    
    public function getAllCarts() {
        return $this->db->get(CART)->result();
    }

    /**
        Get all active carts in db

        @return PHP Object of all cart
    **/
    
    public function getAllActiveCarts() {
        return $this->db
        ->join("user_table ut", "ut.user_id = ct.user_id")
        ->get_where("cart_table ct", array("flag" => 0));
    }
    
    /**
     Get all orders in db
     
     @return PHP Object of all cart
     **/
    
    public function getAllOrders() {
        return $this->db
            ->order_by('date_buy', 'desc')
            ->join("user_table ut", "ut.user_id = ct.user_id")
            ->get_where("cart_table ct", array("flag" => 1));
        }
        
    /**
     Get all user orders in db
     
     @return PHP Object of all cart
     **/
    
    public function getAllUserOrders() {
        return $this->db
            ->order_by('date_buy', 'desc')
            ->join("user_table ut", "ut.user_id = ct.user_id")
            ->get_where("cart_table ct", array("flag" => 1, "ct.user_id" => $this->session->userdata('userid')));
    }

    /**
        Get the user current active cart

        @param int $user_id

        @return int $cart_id
    **/

    public function getUserActiveCartID() {
        $user_id = $this->session->userdata('userid');
        return $cart = $this->db->get_where('cart_table', array("user_id" => $user_id, "flag" => 0))->row()->cart_id;
    }

    /**
        Get the current login user's active cart

        @return bool, TRUE if user has active cart
    **/
    
    public function getUserActiveCart() {
        $user_id = $this->session->userdata('userid');
        return $cart = $this->db->get_where('cart_table', array("user_id" => $user_id, "flag" => 0))->row();
    }
    
    /**
        Check whether the current login user's has active cart

        @return bool, TRUE if user has active cart
    **/


    public function hasActiveCart() 
    {
        return count($this->getUserActiveCart()) > 0;
    }

    /**
        Add new cart if the current login user does not have an active cart

        @return int new $cart_id
    **/

    public function addNewCart() {
        $user_id = $this->session->userdata('userid');
        if (!$this->hasActiveCart($user_id)){
            $array = array("user_id" => $user_id);
            $this->db->insert(CART, $array);
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    /**
        Buy the cart and deactivate all user carts

        @param int $cart_id
        
        @return bool
        **/
        
        public function buyCart($cart_id) {
            $array = array("date_buy" => date("Y-m-d H:i:s", time()));
            $this->db->where("cart_id", $cart_id)->update(CART, $array);
            return $this->deactivateAllUserCart($this->session->userdata('userid'));
        }
        
    /**
        Deactivate all of user's cart
         
        @param int $user_id
    
        return bool
    **/

    private function deactivateAllUserCart($user_id) {
        $array = array("flag" => 1);
        return  $this->db->where(array("user_id" => $user_id))->update(CART, $array);
    }

    /**
        Add product to a cart

        @param int $cart_id int $product_id int $quantity

        @return bool
    **/

    public function addProductToCart($cart_id, $product_id, $quantity) {
        $array = array (
            "cart_id" => $cart_id,
            "product_id" => $product_id,
            "quantity" => $quantity
        );
        return $this->db->insert("product_cart_table", $array);
    }

    /**
        Get all of the products in the cart

        @param int $cart_id

        @return array
    **/

    public function getProductsInCart($cart_id) {
        return $this->db
            ->join("product_table pt", "pt.product_id = pct.product_id")
            ->join('product_images pi', 'pi.product_id = pt.product_id')
            ->join('cart_table ct', 'ct.cart_id = pct.cart_id')
            ->get_where("product_cart_table pct", array("pct.cart_id" => $cart_id))
            ->result();
    }

    /**
        Get the total price of the cart

        @param int $cart_id

        @return int 
    **/
    
    public function getTotalCartPrice($cart_id) {
        $productsInCart = $this->getProductsInCart($cart_id);
        $totalPrice = 0;
        foreach ($productsInCart as $product) {
           $totalPrice += ( $product->price * $product->quantity );
        }
        return $totalPrice;
    }
    
    /**
        Get the cart detail

        @param int $cart_id

        @return PHP Object of cart detail
    **/
    
    public function getCartDetail($cart_id) {
        return $this->db
        ->join("user_table ut", "ut.user_id = ct.user_id")
        ->get_where("cart_table ct", array("ct.cart_id" => $cart_id))->row();
    }
    
    /**
        Remove products from cart

        @param int $pcid

        @return bool
    **/
    
    public function removeFromCart($pcid) {
        return $this->db->where('product_cart_id', $pcid)->delete(PRODUCTCART);
    }
    
    /**
        Remove products from cart

        @param int $pcid

        @return bool
    **/
    
    public function userCartChecking($cartid) {
        $count = $this->db->get_where('cart_table', array('cart_id' => $cartid, "user_id" => $this->session->userdata('userid')))->num_rows();
        if ($count == 0) {
            return false;
        } else {
            return true;
        }
    }
}
