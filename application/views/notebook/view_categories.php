<?php 
echo heading('Categories',3);
$n= 1;
foreach($content->result() as $row)
{
    echo "<a href='". site_url("notebook/category/view_one/$row->c_id") ."' class='div_listings rounded_corners_5px'>";
    echo "<div style='width:30px;float:left;'>". $n . "</div><div style='width:350px;float:left;'>" . $row->c_title . "</div>" . br(1);
    echo "</a>";
    $n++;
}
unset($n);