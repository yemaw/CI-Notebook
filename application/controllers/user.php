<?php

class User extends Controller {

	function User()
	{
		parent::Controller();	
	}
	
	function index()
	{
		if($this->session->userdata('is_login') == TRUE){
            redirect(site_url("notebook/"));
        }
        else{
            $data = array(
                'appname' => 'CodeIgniter Notebook',
                'app_name' => 'system',
                'app_view' => 'welcome'
            );
            $this->load->view('templates/default',$data);
        }
	}
    
	function login()
    {   
        $this->load->model('user_model');
        //Username and password are correct
        if($this->user_model->create_user_session()){ 
            //redirect(site_url("home/"));
            redirect(site_url("notebook/"));
        }  
        //Username and password are incorrect
        else{
			$flash_message = array(
			    'message' => 'Username and password did not match! Please Try Again.',
			    'css_class' => 'red_message'
			);
			$this->session->set_flashdata($flash_message);
			redirect(site_url());
        }
    }
    
    function logout()
    {
         $this->load->model('user_model'); 
         if($this->user_model->destroy_user_session()){
            redirect(site_url());
         }
          
    }
    
    function account_setting()
    {   
        $uid = $this->session->userdata('uid');
        $this->load->model('user_model');
        $userinfo = $this->user_model->get_user_info($uid);
        $task = $this->input->post('task');
        
        switch(strtolower($task)){
             
            //user informaion update process   
            case 'update':
                
                //check user entered data are valid or not
                $this->form_validation->set_rules('password','New Password','min_length[5]|max_length[20]');
                $this->form_validation->set_rules('password2','Confirm New Password','trim|matches[password]');
                $this->form_validation->set_rules('email','Email','trim|valid_email|max_length[25]');
                $this->form_validation->set_rules('fullname','Full Name','trim|max_length[25]');
                
                if($this->form_validation->run() == FALSE){
                    $data = array(
                        'page_title' => 'Account Settings',
                        'appname' => 'Account Settings',
                        'app_name' => 'system',
                        'app_view' => 'account_setting',
                        'content' => $userinfo
                    );
                    $this->load->view('templates/default',$data); 
                }
                
                //check old password if user attempt to change to new password
                elseif(($this->input->post('password')) && (md5($this->input->post('o_password')) != $userinfo['password'])){
                     $flash_message = array(
                        'message' => 'Please enter your old password correctly!',
                        'css_class' => 'red_message'
                    );
                    $this->session->set_flashdata($flash_message);
                    redirect(site_url("user/account_setting"));
                }
                
                //everything now correct
                else{ 
                    if($this->user_model->update_user_info($uid)){
                        $flash_data = array(
                           'message' => 'Your informations sucessfully updated.',
                           'css_class' => 'green_message'
                       );
                    $this->session->set_flashdata($flash_data);
                    redirect(site_url("user/account_setting"));
                    }
                    else{
                        echo "Unexpected error! Bug";exit;
                    }
                }
            break;
            
            //show user information and allow to edit
            default:
            case 'edit':
                $data = array(
                    'page_title' => 'Account Settings',
                    'appname' => 'Account Settings',
                    'app_name' => 'system',
                    'app_view' => 'account_setting',
                    'content' => $userinfo
                );
                $this->load->view('templates/default',$data);
            break;
      
        }
        
    }
    
}