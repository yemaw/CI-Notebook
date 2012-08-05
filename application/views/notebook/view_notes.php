<a href="<?php echo site_url("notebook/category/view_all"); ?>">Manage Categories</a><br />
<a href="<?php echo site_url("notebook/category/new"); ?>">+ Create new Categories</a><br />
<a href="<?php echo site_url("notebook/newnote"); ?>">+ New</a>
<script type="text/javascript">
    function do_filter(){
        var form = document.filter_form;
        document.filter_form.submit();
        return true;
    }
    function reset_filter(){
        var form = document.filter_form;
        document.getElementById('search_box').value = '';
        document.filter_form.submit();
        return true;
    }
    
    function del(nt,nid){
        var form = document.del_form;
        user_action = confirm("Are you sure want to delete " + nt + "?");
        if(user_action == true){
            document.getElementById('del_n_id').value= nid;
            document.del_form.submit();
            return true;   
        }
        else{
           return true;
        }
    
    }
</script>
<?php 
    $category[0] = "All Category";
    foreach($categories->result() as $row){
        $category[$row->c_id] = $row->c_title;
    } 
        echo form_open("notebook/viewnotes",array('name'=>'filter_form'));
        echo "Search :: " . form_input(array('type'=>'text','name'=>'search','id'=>'search_box'),$search_word) . form_input(array('type'=>'button','value'=>'Go'),'','onclick="do_filter()"') ,form_input(array('type'=>'button','value'=>'Reset'),'',"onclick='reset_filter()'");
        echo "<div style='float:right;'>Categories :: " . form_dropdown('fc_id',$category,$current_c,'style="width:200px;max-width:200px;" onchange="do_filter()"') . "</div>";

        echo "<div class='div_listings' style='border-bottom:1px solid #c0c0c0;'>";
        echo "<div style='width:30px;float:left;'><b>#</b></div><div style='width:250px;float:left;'><b>Titles</b></div><div style='width:150px;float:left;'><b>Category</b></div><div style='width:180px;float:left;'><b>Date Create</b></div>" . br(1);
        echo "</div>";
        echo form_close();
        $n = 1;
        foreach($notes->result() as $row){
            echo "<div class='div_listings rounded_corners_5px'>";
            echo "<div style='width:30px;float:left;'>". $n . ")</div>";
            echo "<div style='width:240px;float:left;'><a href='". site_url("notebook/viewnote/$row->n_id") ."'>" . $row->note_title . " </a> </div>";
            echo "<div style='width:125px;float:left;'>" . $row->c_title . "</div>";
            if($row->date_create){$date_create = unix_to_human(gmt_to_local($row->date_create,'UP65',FALSE),FALSE,'us');}
            else{$date_create = NULL;}
            echo "<div style='width:165px;float:left;'>&nbsp;" . $date_create . "</div>";
            echo "<div style='width:50px;float:left;' class='edit_button'>[ <a href='". site_url("notebook/editnote/" . $row->n_id) ."' >Edit</a> ]</div>";
            echo "<div style='width:65px;float:left;' class='edit_button'>[ <a onclick='del(\"" . $row->note_title . "\",". $row->n_id ." )' >Delete</a> ]</div>";
            unset($date_create);
            echo br(1);
            echo "</div>";
            $n++;
        }
unset($n);

//echo $this->pagination->create_links();

echo form_open("notebook/delnote/", array('name'=>'del_form','id'=>'delform'));
echo form_input(array('name'=>'del_n_id','id'=>'del_n_id','type'=>'hidden', 'value' => ''));
echo form_close();