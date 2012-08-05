<?php

class User_register_model extends Model{

    function User_register_model()
    {
        parent::Model();
    }
    
    function check_username()
    {
        $username = $this->input->post('username');
        $this->db->where('username',$username);
        $username_result = $this->db->get('users');
        if($username_result->num_rows() > 0){
            return FALSE;
        }
        else{
            return TRUE;
        }
        
    }
    
    function create_user()
    {   base_url();
        $new_member_data = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'email' => $this->input->post('email'),
            'fullname' => $this->input->post('fullname'),
			'join_time' => now(),
			'time_zone' => 'UP65'
        );
        $insert = $this->db->insert('users',$new_member_data);
        return $insert;   
    }

}