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
            ->join("user_table ut", "ut.user_id = ct.user_id")
            ->get_where("cart_table ct", array("flag" => 1));
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
        Check whether user has active cart

        @param int $user_id

        @return bool, TRUE if user has active cart
    **/

    public function getUserActiveCart() {
        $user_id = $this->session->userdata('userid');
        return $cart = $this->db->get_where('cart_table', array("user_id" => $user_id, "flag" => 0))->row();
    }

    public function hasActiveCart() {
        $cart = $this->getUserActiveCart();
        if (count($cart) != 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
        Add new cart if user does not have an active cart

        @param int $user_id

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
        Buy the current cart and deactivate all user carts

        @param int $cart_id int $user_id

        @return bool
    **/

    public function buyCart($cart_id) {
        $array = array("date_buy" => date("Y-m-d H:i:s", time()));
        $this->db->where("cart_id", $cart_id)->update(CART, $array);
        return $this->deactivateAllUserCart($this->session->userdata('userid'));
    }

    /**
        Deactivate all users cart

        @param int $user_id

        return bool
    **/

    private function deactivateAllUserCart($user_id) {
        $array = array("flag" => 1);
        return  $this->db->where(array("user_id" => $user_id))->update(CART, $array);
    }

    /**
        Add product to user cart

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
        Get all the products in the cart

        @param inr $cart_id

        @return array
    **/

    public function getProductsInCart($cart_id) {
        return $this->db
            ->join("product_table pt", "pt.product_id = pct.product_id")
            ->get_where("product_cart_table pct", array("cart_id" => $cart_id))
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

    public function getCartDetail($cart_id) {
        return $this->db
            ->join("user_table ut", "ut.user_id = ct.user_id")
            ->get_where("cart_table ct", array("ct.cart_id" => $cart_id))->row();
    }

    public function removeFromCart($pcid) {
        return $this->db->where('product_cart_id', $pcid)->delete(PRODUCTCART);
    }
}
?>