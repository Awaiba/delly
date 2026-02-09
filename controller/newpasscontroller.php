<?php
include 'model/dbmodel.php';
$email = "";
if(isset($_GET["email"]))
{
	$email = $_GET["email"];
    $_SESSION['email']=$email;
}

if(empty($_POST))
{
 
    $password=search($email);
include "view/newpassword.php";
return;
}


try {
    if (empty($_POST['newpassword']) || empty($_POST['newcpassword'])){
        $_SESSION['message']="Enter the password to change";
        $_SESSION['status']="error";
        redirect(lost);
        return;
    }
   
    $newpassword = filtertext($_POST['newpassword']);
    if (strlen($newpassword) < 7) {
        $_SESSION['message']="length of password must be >7";
        $_SESSION['status']="warning";
        redirect(lost);
        return;
    }

    $newcpassword = filtertext($_POST['newcpassword']);
   if ($newpassword != $newcpassword) {
    $_SESSION['message']="password and confirm password is not matched";
    $_SESSION['status']="warning";
    redirect(lost);
       return;
   }
$email=$_SESSION['email'];
$new=update_password($newpassword,$email);
if ($new) {
    $_SESSION['message']="Password changed sucessfully";
    $_SESSION['status']="success";
    unset($_SESSION['email']);
      redirect('login');
   } else {
       throwError(500, 'Unable to complete your request.');
       unset($_SESSION['email']);
   }
    } catch (Exception $ex) {
        include 'controller/ErrorController.php';
    }
?>