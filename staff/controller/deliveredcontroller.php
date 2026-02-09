 <?php

include "model/dbmodel.php";

$sid = "";
if(isset($_GET["sid"]))
{
	$sid = $_GET["sid"];
}
$accept= deliver($sid);
if($accept)
{
    $_SESSION['message']="Delivered message has been sent to the user";
    $_SESSION['status']="success";
    redirect('order');
}
else
{
    $_SESSION['message']="Data is not approved";
    $_SESSION['status']="error";
   redirect('order');
}
?>