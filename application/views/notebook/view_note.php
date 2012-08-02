<?php

//this will done only one time, because there is only one note
foreach($note_data->result() as $row){
    echo heading($row->note_title,3);
    echo $row->note_body;
    echo br(3) . "<u>Detail informations     of ". $row->note_title ."</u>" . br(1);
    echo "Category :: " . $row->c_title . br(1);
    echo "Date Created :: " . unix_to_human(gmt_to_local($row->date_create,$user_timezone,FALSE),FALSE,'us') . br(1);
}