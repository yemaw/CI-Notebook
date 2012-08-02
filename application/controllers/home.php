<?php

class Home extends Controller{
    
    function Home()
    {
        parent::Controller();
/*        $this->load->model('user_model');
        if(!$this->user_model->check_user_session()){
            redirect(site_url('user/'));
        } */
    }

    function index()
    {
        
    }
    
    function go_notebook()
    {
        redirect(site_url("notebook/"));
    }
    
}