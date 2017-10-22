<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('category_model');
	}

	/*
	**
	**	This is a JSON Function just to check my category model function
	**
	*/

	public function getAllCategoriesWithSubCategories() {
		$this->gate_model->ajax_gate();
		header('Content-Type: application/json');
		echo json_encode($this->category_model->getAllCategoriesWithSubCategories());
	}

}
?>