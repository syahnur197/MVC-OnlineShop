<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class User extends CI_Controller
	{
		public function __construct() {
			parent::__construct();
			// $this->load->helper("form");
		}

		public function index() {
			$this->load->view('layout/account/header');
			$this->load->view('user/login');
			$this->load->view('layout/account/footer');
		}

		public function dashboard() {
			$this->load->view('layout/account/header');
			$this->load->view('user/dashboard');
			$this->load->view('layout/account/footer');
		}
	}
?>