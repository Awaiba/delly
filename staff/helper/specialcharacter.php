<?php

if (!function_exists("filterText")) {

    function filtertext($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
/*
if (!function_exists("number"))
{
    function number($dat){

    
    $dat=preg_match("/^([0-9]{10})$/",$dat));
    return $dat;
}
}*/