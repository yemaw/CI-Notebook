<?php

class User_model extends Model{
    
    function User_model()
    {
        parent::Model();
        session_start();
    }
       
    /* 
    | description -> return true on sucessfully set user session and false on failuer 
    | return type -> Boolean
    */
    function create_user_session() 
    { 
        $login_data = array('username' => $this->input->post('username'),'password' => md5($this->input->post('password')));
        $row = $this->db->get_where('users',$login_data); 
        if($row->num_rows() == 1){
            $result = $row->row();
            $userdata = array(
                'uid' => $result->uid,
                'username' => $result->username,
                'email' => $result->email,
                'fullname' => $result->fullname,
                'is_login' => TRUE
            );
            $this->session->set_userdata($userdata); 
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    /* 
    | return TRUE  if there is user session and false on no session
    */
    function check_user_session()
    {
        $is_login = $this->session->userdata('is_login');
        if(isset($is_login) && $is_login == TRUE){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    /* 
    | return true on if user session is sucessful destroy(logout)
    */
    function destroy_user_session()
    {
         $this->session->sess_destroy();
         return TRUE;
    }
    
    /*
    | description -> Get user's informations
    | return type -> Array
    */ 
    function get_user_info($uid = NULL)
    {
        if($uid == NULL)exit();  // if unexpected error occur
        $row = $this->db->get_where('users', array('uid' => $uid ) );
        if($row->num_rows() == 1){
            $userinfo = $row->row_array();
            return $userinfo;
        }
        else{
            $this->session->set_userdata(array('is_login' =>FALSE));
            $flash_message = array(
                'message' => "Something Unexpected Wrong. This is a Bug!",
                'css_class' => 'red_message'
            );
            $this->session->set_flashdata($flash_message);
            redirect(site_url());
        }
    }
    
    /*
    | description -> update user's informations
    | params ->  user_id
    | return type -> boolean
    */
    function update_user_info($uid)
    {
        if($uid != $this->session->userdata('uid')){
            exit;
        }
        $data[0] = NULL;
        //assignig update values        
        if($this->input->post('email')){
            $data += array('email' => $this->input->post('email'));
        }
        if($this->input->post('password')){
            $data += array('password' => md5($this->input->post('password')));
        }
        if($this->input->post('fullname')){
            $data += array('fullname' => $this->input->post('fullname'));
        }
        if($this->input->post('time_zone')){
            $data += array('time_zone' => $this->input->post('time_zone'));
        }
        unset($data[0]);
        
        if($this->db->update('users',$data,array('uid'=> $uid))){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    function get_user_timezone($uid){
        $query = "SELECT time_zone FROM users WHERE uid = $uid";
        $result = $this->db->query($query);
        $user_timezone = $result->row_array();
        return $user_timezone['time_zone'];
    }

}