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

    public function register($data)
    {
        return $this->db->insert(USER, $data);
    }

    public function validate()
    {
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

        return $this->form_validation->run();
    }
}
