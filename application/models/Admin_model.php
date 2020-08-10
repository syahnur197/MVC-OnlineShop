<?php

class Admin_model extends CI_Model {

	/**
        Get data of all users with user_type of user

        @param null

        @return PHP Object of users data
    **/
	public function get_users()
	{
		return $this->db->get_where(USER, array("user_type" => "user"));
	}

	/**
        Ban users

        @param int $user_id (DEFAULT = "")

        @return void
    **/

	public function banUser($userid = "")
	{
		return $this->db->where("user_id", $userid)->update(USER, array("ban_flag" => 1));
	}

	/**
        Unban users

        @param int $user_id (DEFAULT = "")

        @return void
    **/

	public function unbanUser($userid = "")
	{
		return $this->db->where("user_id", $userid)->update(USER, array("ban_flag" => 0));
	}
}
