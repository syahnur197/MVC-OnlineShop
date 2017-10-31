<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('account_model');
	}

	/**
        Login Page
    **/
	public function index() {
		$this->load->view('layout/account/header', array("title" => "Login"));
		$this->load->view('account/login');
		$this->load->view('layout/account/footer');
	}

	/**
        Registration Page
    **/
	public function register() {
		$this->load->view('layout/account/header', array("title" => "Register Account"));
		$this->load->view('account/register');
		$this->load->view('layout/account/footer');
	}

	/**
		Registration
		Form validation is done here
		password hashing is done here
		redirect to login page if successful
		redirect to registeration page if unsuccessful
    **/
	public function registerAccount() {
		$this->form_validation->set_rules(
			'FName', 'First Name',
			'trim|required|min_length[5]|max_length[20]|alpha',
			array(
				'required' => 'You have not provided %s.',
				'min_length' => 'Your {field} needs to be at least {param} characters long',
				'max_length' => 'Your {field} needs to be at most {param} characters long',
				'alpha' => 'You may only use alphabet in your {field}'
			)
		);

		$this->form_validation->set_rules(
			'LName', 'Last Name',
			'trim|required|min_length[5]|max_length[20]|alpha',
			array(
				'required' => 'You have not provided %s.',
				'min_length' => 'Your {field} needs to be at least {param} characters long',
				'max_length' => 'Your {field} needs to be at most {param} characters long',
				'alpha' => 'You may only use alphabet in your {field}'
			)
		);

		$this->form_validation->set_rules(
			'username', 'Username',
			'trim|required|min_length[5]|max_length[12]|is_unique[user_table.username]|alpha',
			array(
				'required' => 'You have not provided %s.',
				'is_unique' => 'This %s already exists.',
				'alpha' => 'You may only use alphabet and numbers for your username'
			)
		);

		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user_table.email]|valid_email', 
			array(
				'required' => 'You have not provided %s.',
				'is_unique' => 'This %s already exists.',
				'valid_email' => 'You did not provide a valid E-Mail Address'
			)
		);

		$this->form_validation->set_rules('password', 'Password', 'trim|required',
			array(
				'required' => 'You must provide a %s.'
			)
		);

		$this->form_validation->set_rules('confPassword', 'Password Confirmation', 'trim|required|matches[password]',
			array('required' => 'You must provide a %s.')
		);

		if ($this->form_validation->run() == FALSE) {
			$this->register();
		} else {
			$username = $this->input->post('username', TRUE);
			$email = $this->input->post('email', TRUE);
			$FName = $this->input->post('FName', TRUE);
			$LName = $this->input->post('LName', TRUE);
			$password = $this->input->post('password', TRUE);
			$confPassword = $this->input->post('confPassword', TRUE);

			$array = array(
				"first_name" => $FName,
				"last_name" => $LName,
				"username" => $username,
				"email" => $email,
				"password" => password_hash($password, PASSWORD_DEFAULT),
				"user_type" => "user"
			);

			if ($this->account_model->register($array)){
				$this->session->set_flashdata('fail', '<div class="alert alert-success" style="margin-top:10px" role="alert"> Account Registered Successfully!</div>'); 
				redirect('account');
			} else {
				$this->session->set_flashdata('register', '<div class="alert alert-danger" style="margin-top:10px" role="alert">Failed to register account!</div>'); 
				redirect('account/register');
			}
		}
	}

	/**
		Signing In
		Checking user type to redirect different dashboards
    **/
	public function loggingIn() {
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$data = array(
				"username" => $username,
				"password" => $password
			);
		$result = $this->account_model->login($data);
		if ($result == "user") {
			$this->session->set_flashdata('success', '<div class="alert alert-primary mt-4"role="alert">
  				You have successfully logged in as <span href="#" class="alert-link">'.$username.'</span>. Happy browsing.</div>'); 
			redirect('shop');
		} else if ($result == "admin") {
			$this->session->set_flashdata('success', '<div class="alert alert-primary mt-4" role="alert">
  				You have successfully logged in as <span href="#" class="alert-link">'.$username.'</span>. You are the Admin.</div>'); 
			redirect('Admin');
		} else if ($result == "ban") {
			$this->session->set_flashdata('success', '<div class="alert alert-danger mt-4" role="alert">
  				You are banned from this website.</div>'); 
			redirect('shop');
		} else {
			$this->session->set_flashdata('fail', '<div class="alert alert-danger mt-4" role="alert">
  				Login failed.</div>'); 
			redirect('account');
		}
	}

	/**
        Sign out
    **/
	public function logout()
	{
		$array_items = array('username', 'usertype');
		$this->session->unset_userdata($array_items);
		redirect('shop');
	}
}