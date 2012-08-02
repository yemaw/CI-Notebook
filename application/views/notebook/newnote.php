<script type="text/javascript" src="<?php echo ASSETSPATH; ?>ckeditor/ckeditor.js" ></script>
<script type="text/javascript">
function save(){
    var form = document.submitnote;
        if(form.note_title.value == ''){
            alert("Please Fill Note Title");
            return true;
        }
        if(form.c_id.value == 0){
            alert("Please select a category");
            return true;
        }
        document.submitnote.submit();
}
</script>
<?php
    //make a array for a category drop box
    $category[0] = "Select Category";
    foreach($content->result() as $row){
        $category[$row->c_id] = $row->c_title;
    } 

echo form_open(site_url("notebook/newnote/save_new"),array('name'=>'submitnote'));
echo "<div style='float:left;padding-left:20px;width:160px;'>Note Title :: </div>" . form_input(array('name'=>'note_title','style'=>'width:340px;')) . br(2);
echo "<div style='float:left;'><div style='float:left;padding-left:20px;width:160px;'>Select Category :: </div>" . form_dropdown('c_id',$category,0,'style="width:200px;max-width:200px;"') . "</div>";
echo "<div style='display:none;'><div style='float:left;padding-left:20px;width:100px;'>Hightlight :: </div>" . form_checkbox('hightlight', '2', FALSE) . "</div>" . br(2);
echo form_textarea(array('name'=>'note_body','class'=>'ckeditor','style'=>'width:100%;')) . br (1);
echo form_input(array('type'=>'button','value'=>'Save','onclick'=>'save()'));
echo form_close();
