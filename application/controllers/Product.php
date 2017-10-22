<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->session->keep_flashdata('msg');
	}

	public function getAllProduct() {
		header('Content-Type: application/json');
		echo json_encode($this->db->get('product_table')->result());
	}

	public function searchProduct() {
		$this->gate_model->ajax_gate();
		$search = $_GET['search'];
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode($this->product_model->searchProduct($search)->result());
	}
	
	public function selectProductCategory() {
		$this->gate_model->ajax_gate();
		$categoryID = $_GET['categoryID'];
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode($this->product_model->getCategoryProduct($categoryID)->result());
	}
	
	public function getProductDataJSON($productId) {
		$this->gate_model->ajax_gate();
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode($this->product_model->getProduct($productId)->result());
	}

	public function update($product_id) {
		$product_name = $data["product_name"] = $this->input->post('product_name');
		$data["price"] = $this->input->post('product_price');
		$data["description"] = $this->input->post('product_description');
		$data["category_id"] = $this->input->post('product_category');
		$update = $this->product_model->updateProduct($product_id, $data);
		if ($update) {
			$message = "<div class='alert alert-success alert-dismissable'>";
			$message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
			$message .= "<strong>Success!</strong> $product_name is updated!";
			$message .= "</div>";
		} else {
			$message = "<div class='alert alert-danger alert-dismissable'>";
			$message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
			$message .= "<strong>Fail!</strong> $product_name is not updated!";
			$message .= "</div>";
		}
		$this->session->set_flashdata('msg', $message); 
		redirect('admin/view_product');
	}
	
	public function add() {
		$product_name = $data["product_name"] = $this->input->post('product_name');
		$data["price"] = $this->input->post('product_price');
		$data["description"] = $this->input->post('product_description');
		$data["category_id"] = $this->input->post('product_category');
		$data["seller_id"] = $this->session->userdata('userid');
		$insert = $this->product_model->addProduct($data);
		if ($insert) {
			$message = "<div class='alert alert-success alert-dismissable'>";
			$message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
			$message .= "<strong>Success!</strong> $product_name is added!";
			$message .= "</div>";
		} else {
			$message = "<div class='alert alert-danger alert-dismissable'>";
			$message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
			$message .= "<strong>Fail!</strong> Fail to add $product_name";
			$message .= "</div>";
		}
		$this->session->set_flashdata('msg', $message); 
		redirect('admin/view_product');
	}

}
?>