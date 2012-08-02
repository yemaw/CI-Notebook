<?php 

/*
| description -> return CI Time Zone Reference Code to Human Time Zone
| return -> human time zone (string)
*/
if(!function_exists('timezoneref_to_human')){
    function timezoneref_to_human($tzr){
        $CI =& get_instance();
        $CI->lang->load('date');
        
        if($tzr == 'GMT'){$tzr = 'UTC';}
        
        return $CI->lang->line($tzr);
    }
}