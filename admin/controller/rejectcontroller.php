<?php
   
include "model/dbmodel.php";

$uid = "";
if(isset($_GET["uid"]))
{
	$uid = $_GET["uid"];
}
$accept= reject($uid);
if($accept)
{
    redirect("request");
}
else
{
    $_SESSION['message']="Data is not approved";
    $_SESSION['status']="error";
    redirect("request");
}