<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class User extends CI_Controller
	{
		public function __construct() {
			parent::__construct();
			$this->load->model('user_model');
			// $this->load->helper("form");
		}

		public function index() {
			$this->load->view('layout/account/header');
			$this->load->view('user/login');
			$this->load->view('layout/account/footer');
		}

		public function dashboard() {
			$this->load->view('layout/account/header', array('title' => 'User Dashboard'));
			$this->load->view('layout/dashboard/usersidebar');
			$this->load->view('user/dashboard');
			$this->load->view('layout/account/footer');
			$this->load->view('layout/dashboard/logout');
		}

		public function change_details() {		
			$data['userData']= $this->user_model->get_userdetail()->row();
			$this->load->view('layout/account/header', array('title' => 'User Dashboard'));
			$this->load->view('layout/dashboard/usersidebar');
			$this->load->view('user/change_details', $data);
			$this->load->view('layout/account/footer');
			$this->load->view('layout/dashboard/logout');
		}

		public function change_userdetail() {
			$data['first_name'] = $this->input->post('fname');
			$data['last_name'] 	= $this->input->post('lname');
			$data['username'] 	= $this->input->post('username');
			$data['email'] 		= $this->input->post('email');
			$message = 'Your account detail is successfully updated.';
			$this->session->set_flashdata('msg', $message); 
			$this->user_model->update_userdetail($this->session->userdata('userid'), $data);
			redirect(site_url('user/change_details'));
		}

		public function change_password() {
			$data['userData']	=	$this->user_model->get_userdetail()->row();
			$this->load->view('layout/account/header', array('title' => 'User Dashboard'));
			$this->load->view('layout/dashboard/usersidebar');
			$this->load->view('user/change_password', $data);
			$this->load->view('layout/account/footer');
			$this->load->view('layout/dashboard/logout');
		}

		public function change_userpassword() {
			$data['oldpassword']	=	$this->input->post('oldpassword');
			$data['newpassword']	=	$this->input->post('newpassword');
			$data['renewpassword']	=	$this->input->post('renewpassword');

			$this->user_model->change_userpassword($data);
		}
	}
?>