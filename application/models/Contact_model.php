<?php

class Contact_model extends CI_Model {

    /**
		Add message send from contact us form

		@return bool
	**/
    
    public function addMessage($data) {
        return $this->db->insert('contact_table', $data);
    }

    /**
        Get all messages ordered in revese chronological order

        @return PHP object
    **/
    
    public function getMessages() {
        return $this->db
        ->order_by('submit_time', 'desc')
        ->get('contact_table');
    }

    /**
        Get a message detail

        @param int $message_id

        @return PHP object
    **/
    
    public function getMessage($message_id) {
        return $this->db
        ->get_where('contact_table', array('message_id' => $message_id));
    }

    /**
        Get new messages count

        @return number
    **/
    
    public function getNewMessagesCount() {
        return $this->db->get_where('contact_table', array("flag" => 0))->num_rows();
    }
    
    /**
        Set a message flag from 0 to 1

        @return bool
    **/

    public function readMessage($message_id) {
        return $this->db->where('message_id', $message_id)->update('contact_table', array('flag' => 1));
    }
}
