<?php

class Gate_model extends CI_Model {
    
    /**
     Bounce users off from accessing ajax links
     **/
    function ajax_gate() {
        if (!$this->input->is_ajax_request()) {
            $message = "<div class='alert alert-danger alert-dismissable my-4'>";
            $message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
            $message .= "<strong>Warning!</strong> You are not allowed to visit this link!";
            $message .= "</div>";
            $this->session->set_flashdata("success", $message );
            redirect('shop');
        }
    }

    /**
	 Bounce users off the admin dashboard
	 **/
	public function admin_gate() {
		if ($this->session->userdata('usertype') != 'admin') {
			$message = "<div class='alert alert-danger alert-dismissable my-4'>";
			$message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
			$message .= "<strong>Warning!</strong> You are not the admin!";
			$message .= "</div>";
			$this->session->set_flashdata("success", $message );
			redirect('shop');
		}
    }
    
    /**
     Bounce users off the user dashboard
    **/
    public function user_gate() {
        if ($this->session->userdata('usertype') != 'user') {
            $message = "<div class='alert alert-danger alert-dismissable my-4'>";
            $message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
            $message .= "<strong>Warning!</strong> You are not a registered user!";
            $message .= "</div>";
            $this->session->set_flashdata("success", $message );
            redirect('shop');
        }
    }

}