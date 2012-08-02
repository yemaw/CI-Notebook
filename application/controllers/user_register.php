<?php

class User_register extends Controller{
    
    function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[25]');
        $this->form_validation->set_rules('fullname', 'Full Name', 'required|trim|max_length[25]');
        
        //Check user entered data are valid or not
        if($this->form_validation->run() == FALSE){
            $data = array(
				'appname' => 'CodeIgniter',
				'app_name' => 'system',
				'app_view' => 'welcome'
			);
            $this->load->view('templates/default',$data);  
        } 
        
        else{
            $this->load->model('user_register_model');
            
            //Check username is avaiable or not
            if(!$this->user_register_model->check_username()){
				$flash_message = array(
					'message' => "Your chosen username already taken! Please choose others.",
					'css_class' => 'red_message'
				);
                $this->session->set_flashdata($flash_message);
				redirect(site_url());
            }

            else{
                //All fields are valid now and create user
                if($this->user_register_model->create_user()){
					$flash_message = array(
						'message' => "Congrats! You may now login.",
						'css_class' => 'green_message'
					);
					$this->session->set_flashdata($flash_message);
                    redirect(site_url());
                }
                else{
					$flash_message = array(
						'message' => "Something Unexpected Wrong. This is a bug!",
						'css_class' => 'red_message'
					);
					$this->session->set_flashdata($flash_messagte);
                    redirect(site_url());
                }
            }
        }
    }

}