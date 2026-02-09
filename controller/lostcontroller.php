<?php
include 'model/dbmodel.php';
if (empty($_POST)) {
    
   
   include 'view/emailverify.php';
    return;
}

try {
    if (empty($_POST['lemail'])) {
        $_SESSION['message']="Enter You Email";
        $_SESSION['status']="error";
        include 'view/home.php';
        return;
    }
    $email = filtertext($_POST['lemail']);

    $forget = lost($email);

 if ($forget) {
           
            header("location:" . $base_url."?r=newpass&email=".$forget['email']);
        }
        else {
            $_SESSION['message']="No User found";
            $_SESSION['status']="error";
            include 'view/home.php';
            return;
        }
    } catch (Exception $ex) {
        include 'controller/ErrorController.php';
    }
?>