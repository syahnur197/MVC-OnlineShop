<?php

define("CART", 'cart_table ct');
define("PRODUCTCART", 'product_cart_table pct');
define ("PRODUCT", 'product_table pt');

class Cart_model extends CI_Model {

    /**
        Get all cart of the user

        @param int $user_id

        @return PHP Object of all user cart 
    **/

	public function getAllUserCart($user_id) {
        return $this->db->get_where(CART, array( 'user_id' => $user_id ))->result();
    } 

    /**
        Get all carts in db

        @return PHP Object of all cart
    **/
    
    public function getAlLCarts() {
        return $this->db->get(CART)->result();
    }

    /**
        Get the user current active cart

        @param int $user_id

        @return int $cart_id
    **/

    public function getUserActiveCartID($user_id ="") {
        return $this->db->get_where(CART, array("user_id" => $user_id, "flag" => 0))->row()->cart_id;
    }

    /**
        Check whether user has active cart

        @param int $user_id

        @return bool, TRUE if user has active cart
    **/

    public function hasActiveCart($user_id) {
        $cart = $this->getUserActiveCartID($user_id);
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

    public function addNewCart($user_id) {
        if (!$this->hasActiveCart($user_id)) {
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

    public function buyCart($cart_id, $user_id) {
        $array = array("date_buy" => date("Y-m-d H:i:s", time()));
        $this->db->where("cart_id", $cart_id)->update(CART, $array);
        return $this->deactivateAllUserCart($user_id);
    }

    /**
        Deactivate all users cart

        @param int $user_id

        return bool
    **/

    public function deactivateAllUserCart($user_id) {
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
        return $this->db->insert(PRODUCTCART, $array);
    }

    /**
        Get all the products in the cart

        @param inr $cart_id

        @return array
    **/

    public function getProductsInCart($cart_id) {
        return $this->db
            ->join(PRODUCT, "pt.product_id = pct.product_id")
            ->get_where(PRODUCTCART, array("cart_id" => $cart_id))
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
}
?>