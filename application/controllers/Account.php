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
        
        if (!$this->account_model->validate()) {
            $this->register();
            return;
        }

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

    /**
        Signing In
        Checking user type to redirect different dashboards
    **/
    public function loggingIn() {
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $data = [
            "username" => $username,
            "password" => $password,
        ];

        $result = $this->account_model->login($data);
        
        $redirect_to   = "";
        $flash_type    = "";
        $flash_content = "";

        if ($result == "user") {
            $redirect_to   = 'shop';
            $flash_type    = 'success';
            $flash_content = '<div class="alert alert-primary mt-4"role="alert">You have successfully logged in as <span href="#" class="alert-link">'.$username.'</span>. Happy browsing.</div>';
        } else if ($result == "admin") {
            $redirect_to   = 'Admin';
            $flash_type    = 'success';
            $flash_content = '<div class="alert alert-primary mt-4" role="alert">You have successfully logged in as <span href="#" class="alert-link">'.$username.'</span>. You are the Admin.</div>';
        } else if ($result == "ban") {
            $redirect_to   = 'shop';
            $flash_type    = 'success';
            $flash_content = '<div class="alert alert-danger mt-4" role="alert">You are banned from this website.</div>';
        } else {
            $redirect_to   = 'account';
            $flash_type    = 'fail';
            $flash_content = '<div class="alert alert-danger mt-4" role="alert">Login failed.</div>';
        }

        $this->session->set_flashdata($flash_type, $flash_content);
        redirect($redirect_to);
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
