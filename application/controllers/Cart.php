<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CART extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('cart_model');
	}


    // Testing
    public function getTotalCartPrice($cart_id) {
        echo "$ ".$this->cart_model->getTotalCartPrice($cart_id);
    } 
}