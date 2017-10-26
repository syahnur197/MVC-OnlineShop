<?php

class User_model extends CI_Model {

	public function update_userdetail($userid, $data)
	{
		return $this->db->where("user_id", $userid)->update(USER, $data);
	}

	public function get_userdetail()
	{
		return $this->db->get_where(USER, array("user_id" => $this->session->userdata('userid')));
	}

	public function change_userpassword($data) 
	{
		$userid = $this->session->userdata('userid');
		$old = $data['oldpassword'];
		$new = $data['newpassword'];
		$renew = $data['renewpassword'];
		$data = array('password' => password_hash($new, PASSWORD_DEFAULT));
		$query = $this->db->limit(1)->get_where(USER, array('user_id' => $userid))->row();

		if ($new == $renew && password_verify($old, $query->password)){
			$this->db->where('user_id', $userid)->update(USER, $data);
			$this->session->set_flashdata('msg','<div class="alert alert-primary" style="margin-top:5px" role="alert">Password changed.</div>');
			redirect(site_url('user/change_password'));
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-danger" style="margin-top:5px" role="alert">Password change failed.</div>');
			redirect(site_url('user/change_password'));	
		}

	}
}

?>