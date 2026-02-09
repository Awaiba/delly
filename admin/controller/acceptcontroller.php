 <?php
   
include "model/dbmodel.php";

$uid = "";
if(isset($_GET["uid"]))
{
	$uid = $_GET["uid"];
}
$accept= accept($uid);
if($accept)
{
    $_SESSION['message']="Accepted";
    $_SESSION['status']="success";
    redirect("request");
}
else
{
    $_SESSION['message']="Cannot Reject";
    $_SESSION['status']="error";
    redirect("request");
}