<script type="text/javascript">
    function save(){
        var form = document.create_category;
        if(form.c_title.value == ''){
            alert("Please Fill Category Name");
        }
        else{
            document.create_category.submit();
        }
        return true;
    }            
</script>
<?php
echo heading('Create Category',3);
echo form_open("notebook/category/save",array('name'=>'create_category'));
echo "<div style='float:left;width:200px;'>Category Name :: </div>" . form_input(array('type'=>'text','name'=>"c_title",'style'=>"width:400px;")) . br(2);
echo "<div style='float:left;width:200px;'>Category Description :: </div>" . form_textarea(array('type'=>'text','name'=>"c_desc",'style'=>"width:400px;height:60px;")) . br(2);
echo form_input(array('type'=>'button','onClick'=>"save()",'value'=>'Save','style'=>'width:100px;margin-left:500px;'));
echo form_close();

