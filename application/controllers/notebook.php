<?php defined('CI') or die('Access Denied'); ?>
<?php

class Notebook extends Controller{
    
    function Notebook()
    {
        parent::Controller();
        $this->load->model("user_model");
        if(!$this->user_model->check_user_session()){
            redirect(site_url());
        }
        $this->load->model('notebook/notebook_model');
    }
    
    function index()
    {
        redirect(site_url("notebook/viewnotes"));
    }
    
    function category($task = 'view_all',$c_id = NULL)
    {    
        $uid = $this->session->userdata('uid');

        switch(strtolower($task)){
            
            case 'new':      //create new category
               $data = array(
                    'page_title' => 'Create new category',
                    'appname' => '',
                    'app_name' => 'notebook',
                    'app_view' => 'create_category'
                );
                $this->load->view('templates/default',$data);
            break;
            
            case 'save':     //save new category
                if($this->notebook_model->category('save',$uid)){
                     $flash_message = array(
                        'message' => 'Successfuly created '. $this->input->post('c_title') . '!',
                        'css_class' => 'green_message'
                    );
                    $this->session->set_flashdata($flash_message);
                    redirect(site_url("notebook/"));
                }
                else{
                    $flash_message = array(
                        'message' => 'Error in saving new category!',
                        'css_class' => 'red_message'
                    );
                    $this->session->set_flashdata($flash_message);
                    redirect(site_url("notebook/"));
                }
            break;
            
            case 'edit':     //edit existing category
               $this->notebook_model->category('edit',$uid,$c_id);
            break;
            
            case 'view_one':     //view existing category details
                //if there is no category id in url redirect to categories view
                if($c_id == NULL){
                    $flash_message = array(
                         'message' => 'Need category ID to process! Please retry again.',
                         'css_class' => 'red_message'
                    );
                        $this->session->set_flashdata($flash_message);
                        redirect(site_url("notebook/category"));    
                }
                //if user access categroy is not own by him,                 
                if(!$this->notebook_model->check_cid_uid($uid,$c_id)){
                    $flash_message = array(
                         'message' => 'Warning!!! You can only view the category you own. ',
                         'css_class' => 'red_message'
                    );
                    $this->session->set_flashdata($flash_message);
                    redirect(site_url("notebook/category"));
                }
                //user has permission to access that category
                else{
                    $content = $this->notebook_model->category('view_one',$uid,$c_id); 
                    
                    $data = array(
                        'page_title' => 'Category Details',
                        'appname' => '',
                        'app_name' => 'notebook',
                        'app_view' => 'view_category',
                        'content' => $content
                    );
                    $this->load->view('templates/default',$data);
                }
            break;
            
            default:
            case 'view_all': //view all categories
               $content = $this->notebook_model->category('view_all',$uid);
               
               $data = array(
                    'page_title' => 'Categories',
                    'appname' => '',
                    'app_name' => 'notebook',
                    'app_view' => 'view_categories',
                    'content' => $content
                );
                $this->load->view('templates/default',$data);
            break;
            
        }
        
    }
    
    function newnote($task = NULL)
    {
        $task = strtolower($task);
        $uid = $this->session->userdata('uid');
        
        //check user's categories
        $categories = $this->notebook_model->get_categories($uid);
        if($categories->num_rows() < 1){                    
            $flash_message = array(
                 'message' => 'Please create a category first!',
                 'css_class' => 'red_message'
            );
            $this->session->set_flashdata($flash_message);
            redirect(site_url("notebook/category/new"));    
        }

        switch($task){
               
            case 'save_new':
                if($this->notebook_model->save_new_note($uid)){
                    $flash_message = array(
                         'message' => 'Sucessful save your note!',
                         'css_class' => 'green_message'
                    );
                    $this->session->set_flashdata($flash_message);
                    redirect(site_url("notebook/viewnotes"));    
                }
                else{
                    $flash_message = array(
                         'message' => 'Errors in saving your note!',
                         'css_class' => 'red_message'
                    );
                    $this->session->set_flashdata($flash_message);
                    redirect(site_url("notebook/veiwnotes"));
                }
                
            break;
            
            default: //show new note form
                
                $data = array(
                    'page_title' => 'New Note',
                    'appname' => '',
                    'app_name' => 'notebook',
                    'app_view' => 'newnote',
                    'content' => $categories
                );
                $this->load->view('templates/default',$data);
            break;
            
        }
    }
    
    function viewnotes()
    {
        $this->load->library('pagination');
        $uid = $this->session->userdata('uid');
        
        $where = 'WHERE ';       //start for WHERE clause
        $where .= "nd.uid = '$uid' ";  //essential
        $where .= "AND status <> '0' ";
        
        if($this->input->post('search')){$where .= "AND nd.note_title LIKE '%" . $this->input->post('search') . "%' ";                  $search_word = $this->input->post('search');}
        else{$search_word = NULL;}
        if($this->input->post('fc_id')){$where .= "AND nd.c_id = " . $fc_id = $this->input->post('fc_id') . " ";$current_c =            $this->input->post('fc_id');}
        else{$current_c = 0;}
        if(!$this->input->post('orderby')){$where .= "ORDER BY n_id DESC ";}
        
        $config['base_url'] = site_url("notebook/viewnotes");
        $config['per_page'] = '3';
        
        //$limit = "LIMIT "; //start for LIMIT clause
        //if($this->uri->segment(3))$from = $this->uri->segment(3);
        //else{$from = 1;}
        //$from = $from * $config['per_page'];
        //$limit .= $from  . "," . $config['per_page'];
        
        $notes = $this->notebook_model->get_notes($where);
        $categories = $this->notebook_model->get_categories($uid);        
        
        //$config['total_rows'] = $notes->num_rows();
        
        //$this->pagination->initialize($config);
         
        $data = array(
                    'page_title' => 'View Notes',
                    'appname' => '',
                    'app_name' => 'notebook',
                    'app_view' => 'view_notes',
                    'notes' => $notes,
                    'categories' => $categories,
                    'current_c' => $current_c,
                    'search_word' => $search_word
                );
        $this->load->view('templates/default',$data);
    }
    
    function viewnote($n_id)
    {
        $uid = $this->session->userdata('uid');
        
        $note_data = $this->notebook_model->get_single_note($n_id, $uid);   
        $user_timezone = $this->user_model->get_user_timezone($uid);
        
        $data = array(
                    'page_title' => 'New Note',
                    'appname' => '',
                    'app_name' => 'notebook',
                    'app_view' => 'view_note',
                    'user_timezone' => $user_timezone,  
                    'note_data' => $note_data
                );
        $this->load->view('templates/default',$data);
    }
    
    function editnote($n_id)
    {
        $uid = $this->session->userdata('uid');
        //check user permission
        if(!$this->notebook_model->check_nid_uid($uid,$n_id)){
            $flash_message = array(
                  'message' => 'Warning!!! You have no permission to edit this note. ',
                  'css_class' => 'red_message'
                  );
            $this->session->set_flashdata($flash_message);
            redirect(site_url("notebook/viewnotes"));           
        }
        
        if($this->input->post('task')){$task = $this->input->post('task');}
        else{$task = 'edit';}
        switch(strtolower($task))
        {
            
            case "save":
                if($this->notebook_model->save_edit_note($uid,$n_id)){
                    $flash_message = array(
                         'message' => 'Sucessful save your edited note!',
                         'css_class' => 'green_message'
                    );
                    $this->session->set_flashdata($flash_message);
                    redirect(site_url("notebook/viewnotes"));    
                }
                else{
                    $flash_message = array(
                         'message' => 'Errors in saving your note!',
                         'css_class' => 'red_message'
                    );
                    $this->session->set_flashdata($flash_message);
                    redirect(site_url("notebook/viewnotes"));
                }    
            break;
            
            case "edit":
            default:
                $note_data = $this->notebook_model->get_single_note($n_id, $uid);
                $categories = $this->notebook_model->get_categories($uid);
                
                $data = array(
                        'page_title' => 'Edit Note',
                        'appname' => '',
                        'app_name' => 'notebook',
                        'app_view' => 'edit_note',  
                        'categories' => $categories,
                        'content' => $note_data
                    );
                $this->load->view('templates/default',$data);
                break;
        }  
   }
   
   function delnote()
   {
         $uid = $this->session->userdata('uid');
         $n_id = $this->input->post('del_n_id');
         if($this->notebook_model->check_nid_uid($uid,$n_id)){
             //user has permission to delete this note and deletion is successful
             if($this->notebook_model->del_note($n_id,$uid)){
                $flash_message = array(
                  'message' => 'Successfuly Deleted',
                  'css_class' => 'green_message'
                  );
                  $this->session->set_flashdata($flash_message);
            }
            //user has permission to delete this note but deletion is fail
            else{
                 $flash_message = array(
                  'message' => 'Something Wrong!',
                  'css_class' => 'red_message'
                  );
                  $this->session->set_flashdata($flash_message);    
            }
         }
         //user has not permitted to delete this note
         else{
             $flash_message = array(
                  'message' => 'Access Denied',
                  'css_class' => 'red_message'
             );
             $this->session->set_flashdata($flash_message);
         }
         redirect(site_url("notebook/viewnotes"));
   }
    
}