<?php

class Notebook_model extends Model{

    function Notebook_model()
    {
        parent::Model();
    }
    
    /*
    | description -> category function
    | params -> task, user id, category id
    */
    function category($task,$uid,$c_id = NULL)
    {
        switch(strtolower($task)){
        
            case 'save':
                $cinfo = array('c_title' => $this->input->post('c_title'),'uid'=>$uid);
                if($this->input->post('c_desc')){
                    $cinfo += array('c_desc' => $this->input->post('c_desc'));
                }
                $result = $this->db->insert('notebook_categories',$cinfo);
                return $result;
            break;
            
            case 'view_all':
                $result = $this->db->get_where('notebook_categories',array('uid'=>$uid));
                return $result;
            break;
            
            case 'view_one':
                $result = $this->db->get_where('notebook_categories',array('c_id'=> $c_id,'uid' => $uid));
                if($result->num_rows != 1){
                    $flash_message = array(
                         'message' => 'Errors in database! This is a bug :(',
                         'css_class' => 'red_message'
                    );
                    $this->session->set_flashdata($flash_message);
                    redirect(site_url('notebook/category/view_all'));
                }
                return $result;
            break;

            
        }
    }
    
    /*
    | description -> save new user submitted note
    | return -> TRUE on sucessfully insert one new note and FALSE on fail | redirect if user access unauthorize category
    */
    function save_new_note($uid)
    {
        $note_title = $this->input->post('note_title');
        $note_body = $this->input->post('note_body');
        $c_id = $this->input->post('c_id');
        
        if($this->input->post('hightlight')) $status = $this->input->post('hightlight');
        else $status = 1;
        
        $note_data = array(
            'note_title' => $note_title,
            'note_body' => $note_body,
            'uid' => $uid,
            'c_id' => $c_id,
            'date_create' => now(),
            'status' => $status
        );
        //check user really own that category
        if($this->check_cid_uid($uid,$c_id)){
            if($this->db->insert('notebook_data',$note_data)){
                return TRUE;    
            }
            else return FALSE;
        }
        //user try to edit the category that doesn't own by him 
        else{
            $flash_message = array(
                 'message' => 'Please do not try to access the category that you doesn\'t own!',
                 'css_class' => 'red_message'
            );
            $this->session->set_flashdata($flash_message);
            redirect(site_url("notebook/category/new"));
        }
    }
    
    
    function save_edit_note($uid,$n_id)
    {
      $note_title = $this->input->post('note_title');
      $note_body = $this->input->post('note_body');
      $c_id = $this->input->post('c_id');
      if(!$this->check_cid_uid($uid,$c_id)){
            $flash_message = array(
                  'message' => 'Access Denied! Your note did not save.',
                  'css_class' => 'red_message'
            );
            $this->session->set_flashdata($flash_message);
            redirect(site_url("notebook/editnote/$n_id"));
            exit;
      }
      $query = "UPDATE notebook_data SET note_title = '$note_title', note_body = '$note_body', c_id = '$c_id' WHERE uid = $uid AND n_id = $n_id";
      if($this->db->query($query))return TRUE;
      else return FALSE;
    }
    
    /*
    | description -> check user access category is really own by that user or not
    | params -> user id , category id
    | return type -> TRUE(bool) on user is actually own that category and FALSE(bool) on user not own that category
    */
    function check_cid_uid($uid,$c_id)
    {
        $query = "SELECT * FROM notebook_categories WHERE c_id = $c_id";
        $obj = $this->db->query($query);            
        if(!$obj->num_rows() == 1){
            return FALSE;
        }
        else{
            foreach($obj->result() as $row){
                $result = $row->uid;
            }
            if($result == $uid){return TRUE;}
            else{return FALSE;}
        }
    }
    
    /*
    | description -> check user access note is really own by that user or not
    | params -> user id , note id
    | return type -> TRUE(bool) on user is actually own that note and FALSE(bool) on user not own that note
    */
    function check_nid_uid($uid,$n_id)
    {
        $query = "SELECT * FROM notebook_data WHERE n_id = $n_id AND uid = $uid";
        $obj = $this->db->query($query);            
        if($obj->num_rows() == 1){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    /*
    | description -> get a user's cetegory ids and names
    | return -> string
    */
    function get_categories($uid)
    {
        $this->db->select('c_id,c_title');
        $this->db->where(array('uid' => $uid));
        $results = $this->db->get('notebook_categories');
        return $results;
    }
    
    function get_notes($where = NULL, $limit = NULL)
    {
        $query = "SELECT nd.note_title,nd.n_id, nc.c_title, nc.c_id, nd.date_create
                  FROM notebook_data AS nd INNER JOIN notebook_categories AS nc
                  ON nd.c_id = nc.c_id "
                  . $where . $limit;
        $results = $this->db->query($query);
        
        return $results;
    }
    
    function get_single_note($n_id = '', $uid = '' )
    {
        $query = "SELECT * FROM notebook_data INNER JOIN notebook_categories ON notebook_data.c_id = notebook_categories.c_id WHERE notebook_data.n_id = $n_id AND notebook_data.uid = $uid ";
        $result = $this->db->query($query);
        
        return $result;
    }
    
    function del_note($n_id,$uid)
    {
        $query = "DELETE FROM notebook_data WHERE n_id = $n_id AND uid = $uid";
        if($this->db->query($query)){
            return TRUE;
        }
        else{
            return FALSE;        
        }
    }
}