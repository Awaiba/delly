 <?php
    
include "model/dbmodel.php";
    

$sid ="";
$uid = "";

	
    $sid = $_GET["sid"];
    $uid = $_GET["uid"];



$accept= accept($sid,$uid);
if($accept)
{
   
   redirect('adminrequest');
}
else
{
    $_SESSION['message']="Data is not approved";
    
    $_SESSION['status']="error";
    redirect('adminrequest');
}

