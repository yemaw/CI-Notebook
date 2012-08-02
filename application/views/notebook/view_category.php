<?php

foreach ($content->result() as $row)
{
    echo heading($row->c_title,3) . $row->c_desc;
}