<?php

class Account_model extends CI_Model {

	/**
        Login User

        @param arr $data [USER LOGIN CREDENTIAL]

        @return bool FALSE if unsuccessful
        @return String $user_type
	**/
	public function login($data) {
		$query = $this->db
			->limit(1)
			->get_where(USER, array("username" => $data["username"]))
			->row();
		if (password_verify ( $data['password'], $query->password ) && $query->ban_flag == 0) {
			$data = array ("username" => $query->username, "usertype" => $query->user_type, "userid" => $query->user_id);
			$this->session->set_userdata($data);
			return  $query->user_type;
		} elseif($query->ban_flag == 1){
			return "ban";
		} else { 
			return false; 
		}	
	}

	/**
        Register user

        @param arr $data [USER CREDENTIAL]

        @return bool TRUE if successfuly
    **/

	public function register($data) {
		return $this->db->insert(USER, $data);
	}

	/**
        Bounce un-logged in users of user dashboard
	**/
	public function userGate () {}

}
?>